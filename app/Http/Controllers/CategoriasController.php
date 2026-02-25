<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categorias;

class CategoriasController extends Controller
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

        $categoria = Categorias::create($validatedData);

        return redirect()->route('productos.index')
            ->with('success', 'Categoria creada exitosamente');
    }
}

