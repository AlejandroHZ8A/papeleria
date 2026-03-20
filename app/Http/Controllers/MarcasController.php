<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marcas;

class MarcasController extends Controller
{
    /**
     * Guardar una nueva marca
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);
       
        $marca = new Marcas();
        $marca->nombre = $request->nombre;
        
        $rutaimg = 'imagenes/marcas/default.webp';
        
        if($request->hasFile('imagen')){
            $rutaimg = $request->file('imagen')->store('imagenes/marcas', 'public');
        }
        
        $marca->imagen = $rutaimg;
        $marca->save();

        return redirect()->route('productos.index')
            ->with('success', 'Marca creada exitosamente');
    }
}
