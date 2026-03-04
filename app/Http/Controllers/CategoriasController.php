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
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
       
        $categoria = new categorias();
        $categoria->nombre = $request->nombre;
        
        $rutaimg = 'imagenes/categorias/default.webp';
        
        if($request->hasFile('imagen')){
            $rutaimg = $request->file('imagen')->store('imagenes/categorias', 'public');
        }
        
        $categoria->imagen = $rutaimg;
        $categoria->save();

        // return redirect()->route('productos.index')
        // ->with('success', 'Categoria creada exitosamente');
        return response()->json([
            'categoria' => $categoria,
            'message' => 'Categoria creada exitosamente'
        ],200); 
    }
}

