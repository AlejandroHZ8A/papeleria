<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PedidoController extends Controller
{
    /**
     * Ver historial de pedidos de un cliente específico.
     * GET /api/clientes/{cliente_id}/pedidos
     */
    public function index($cliente_id)
    {
        $pedidos = Pedido::with('productos')
                        ->where('cliente_id', $cliente_id)
                        ->orderBy('fecha', 'desc')
                        ->get();

        return response()->json([
            'success' => true,
            'data' => $pedidos
        ], 200);
    }

    /**
     * Crear un nuevo pedido por cliente con múltiples productos.
     * POST /api/pedidos
     */
    public function store(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'productos' => 'required|array',
            'productos.*.producto_id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:1',
            'descuento' => 'nullable|numeric|min:0'
        ]);

        try {
            // Usamos una transacción para asegurar que el pedido y sus productos se guarden juntos
            return DB::transaction(function () use ($request) {
                $total = 0;
                $items_para_insertar = [];

                // Calcular el total basándonos en los precios reales de los productos
                foreach ($request->productos as $item) {
                    $producto = Producto::find($item['producto_id']);
                    $subtotal = $producto->precio * $item['cantidad'];
                    $total += $subtotal;

                    $items_para_insertar[$item['producto_id']] = ['cantidad' => $item['cantidad']];
                }

                // Aplicar descuento si existe
                $descuento = $request->descuento ?? 0;
                $total_final = $total - $descuento;

                // 1. Crear el Pedido
                $pedido = Pedido::create([
                    'cliente_id' => $request->cliente_id,
                    'fecha' => Carbon::now(),
                    'descuento' => $descuento,
                    'total' => $total_final,
                    'estado' => 1 // 1 = Activo, 0 = Cancelado
                ]);

                // 2. Asociar los productos (tabla pivote productos_pedidos)
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

    /**
     * Ver detalle de un pedido específico.
     * GET /api/pedidos/{id}
     */
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

    /**
     * Cancelar un pedido (Cambiar estado a 0).
     * DELETE /api/pedidos/{id}
     */
    public function destroy($id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return response()->json(['message' => 'Pedido no encontrado'], 404);
        }

        // En lugar de borrar físicamente, actualizamos el estado como indica tu problemática
        $pedido->update(['estado' => 0]);

        return response()->json([
            'success' => true,
            'message' => 'Pedido cancelado correctamente'
        ], 200);
    }
}
