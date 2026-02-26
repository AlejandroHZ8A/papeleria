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
         $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $departamento = new Departamentos();
        $departamento->nombre = $request->nombre;
        
        $rutaimg = 'imagenes/departamentos/default.webp';
        
        if($request->hasFile('imagen')){
            $rutaimg = $request->file('imagen')->store('imagenes/departamentos', 'public');
        }
        
        $departamento->imagen = $rutaimg;
        $departamento->save();

        return redirect()->route('productos.index')
            ->with('success', 'Departamento creado exitosamente');
    }
}
