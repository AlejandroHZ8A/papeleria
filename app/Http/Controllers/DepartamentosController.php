<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamentos;

class DepartamentosController extends Controller
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

        $departamento = Departamentos::create($validatedData);

        return redirect()->route('productos.index')
            ->with('success', 'Departamento creado exitosamente');
    }
}
