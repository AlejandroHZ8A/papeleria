<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marcas;

class MarcasController extends Controller
{
               /**
     * Guardar una nueva categoria
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|string',
        ]);

        $marca = Marcas::create($validatedData);

        return redirect()->route('productos.index')
            ->with('success', 'Marca creada exitosamente');
    }
}
