<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\clientes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PedidoController extends Controller
{
    /**
     * Ver todos los pedidos registrados en el sistema (Global)
     * GET /api/pedidos
     */
    public function global()
    {
        $pedidos = Pedido::with(['cliente', 'productos'])
                        ->orderBy('fecha', 'desc')
                        ->get()
                        ->map(function ($pedido) {
                            $pedido->estado_texto = ($pedido->estado == 1) ? 'Activo' : 'Cancelado';
                            return $pedido;
                        });

        return response()->json([
            'success' => true,
            'data' => $pedidos
        ], 200);
    }

    /**
     * Ver historial de pedidos de un cliente específico.
     * GET /api/pedidos/historial/{cliente_id}
     */
    public function index($cliente_id)
    {
        $pedidos = Pedido::with('productos')
                        ->where('cliente_id', $cliente_id)
                        ->orderBy('fecha', 'desc')
                        ->get()
                        ->map(function ($pedido) {
                            $pedido->estado_texto = ($pedido->estado == 1) ? 'Activo' : 'Cancelado';
                            return $pedido;
                        });

        return response()->json([
            'success' => true,
            'data' => $pedidos
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'descuento' => 'nullable|numeric|min:0'
        ]);

        try {
            return DB::transaction(function () use ($request) {
                $total = 0;
                $items_para_insertar = [];

                foreach ($request->productos as $item) {
                    $producto = Producto::find($item['producto_id']);
                    
                    // 1. Validar si hay stock suficiente 
                    if ($producto->existencia < $item['cantidad']) {
                        throw new \Exception("Stock insuficiente para el producto: " . $producto->nombre);
                    }

                    // 2. Calcular subtotales para el pedido
                    $subtotal = $producto->precio * $item['cantidad'];
                    $total += $subtotal;

                    // 3. DESCUENTO DE INVENTARIO
                    $producto->existencia -= $item['cantidad'];
                    $producto->save();

                    $items_para_insertar[$item['producto_id']] = ['cantidad' => $item['cantidad']];
                }

                $descuento = $request->descuento ?? 0;
                $total_final = $total - $descuento;

                $pedido = Pedido::create([
                    'cliente_id' => $request->cliente_id,
                    'fecha' => Carbon::now(),
                    'descuento' => $descuento,
                    'total' => $total_final,
                    'estado' => 1
                ]);

                $pedido->productos()->attach($items_para_insertar);

                return response()->json([
                    'success' => true,
                    'message' => 'Pedido creado exitosamente',
                    'data' => $pedido->load('productos')
                ], 201);
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el pedido: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $pedido = Pedido::with(['cliente', 'productos'])->find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pedido
        ], 200);
    }

    public function destroy($id)
    {
        $pedido = Pedido::with('productos')->find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        // Evitar devolver stock si el pedido ya estaba cancelado
        if ($pedido->estado == 0) {
            return response()->json(['message' => 'El pedido ya se encuentra cancelado'], 400);
        }

        try {
            return DB::transaction(function () use ($pedido) {
                // 1. REGRESAR EL STOCK AL INVENTARIO
                foreach ($pedido->productos as $producto) {
                    $cantidad_a_devolver = $producto->pivot->cantidad;
                    
                    $producto->existencia += $cantidad_a_devolver;
                    $producto->save();
                }

                // 2. CAMBIAR EL ESTADO DEL PEDIDO A CANCELADO (0)
                $pedido->update(['estado' => 0]);

                return response()->json([
                    'success' => true,
                    'message' => 'Pedido cancelado y stock devuelto al inventario'
                ], 200);
            });
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cancelar el pedido: ' . $e->getMessage()
            ], 500);
        }
    }
}
