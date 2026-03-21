<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // ─── Ver carrito ────────────────────────────────────────────
    public function index()
    {
        $carrito = session('carrito', []);

        if (empty($carrito)) {
            return redirect()->route('catalogo.index')
                ->with('info', 'Tu carrito está vacío. ¡Agrega productos primero!');
        }

        $total = array_sum(array_map(fn($item) => $item['precio'] * $item['cantidad'], $carrito));

        return view('/carrito/carrito', compact('carrito', 'total'));
    }

    // ─── Agregar producto ────────────────────────────────────────
    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'nombre'      => 'required|string',
            'precio'      => 'required|numeric',
            'imagen'      => 'nullable|string',
        ]);

        $carrito = session('carrito', []);
        $id = $request->producto_id;

        if (isset($carrito[$id])) {
            // Si ya existe, solo suma la cantidad
            $carrito[$id]['cantidad']++;
        } else {
            $carrito[$id] = [
                'producto_id' => $id,
                'nombre'      => $request->nombre,
                'precio'      => (float) $request->precio,
                'imagen'      => $request->imagen ?? '',
                'cantidad'    => 1,
            ];
        }

        session(['carrito' => $carrito]);

        return redirect()->back()->with('success', '¡Producto agregado al carrito!');
    }

    // ─── Actualizar cantidad ─────────────────────────────────────
    public function actualizar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|integer',
            'cantidad'    => 'required|integer|min:1',
        ]);

        $carrito = session('carrito', []);
        $id = $request->producto_id;

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] = $request->cantidad;
            session(['carrito' => $carrito]);
        }

        return redirect()->route('/carrito/carrito')->with('success', 'Cantidad actualizada.');
    }

    // ─── Eliminar producto ───────────────────────────────────────
    public function eliminar($id)
    {
        $carrito = session('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session(['carrito' => $carrito]);
        }

        // Si queda vacío redirige al catálogo
        if (empty($carrito)) {
            return redirect()->route('catalogo.index')
                ->with('info', 'Tu carrito quedó vacío.');
        }

        return redirect()->route('/carrito/carrito')->with('success', 'Producto eliminado.');
    }

    // ─── Vaciar carrito ──────────────────────────────────────────
    public function vaciar()
    {
        session()->forget('carrito');

        return redirect()->route('catalogo.index')
            ->with('info', 'Tu carrito fue vaciado.');
    }
}