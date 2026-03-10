<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\imagenes;

class imagenesController extends Controller
{
    public function index()
    {
        $imagenes = imagenes::all();
      //  return view('imagenes.index', compact('imagenes'));
      return response()->json([
        'imagenes' => $imagenes,
        'message' => 'Imagenes obtenidas exitosamente'
    ],200); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required',
            'url_imagen' => 'required',
        ]);
        $imagenes = new imagenes();
        $imagenes->producto_id = $request->producto_id;
        $imagenes->url_imagen = 'imagenes/productos/default.webp';
        $imagenes->save();
        return redirect()->route('imagenes.index');
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nuevaImg = 'producto_' . $producto->id_producto . '.' . $imagen->getClientOriginalExtension();
            $ruta = $imagen->storeAs('imagenes/productos', $nuevaImg, 'public');
            $imagenes->url_imagen = $ruta; // solo la ruta relativa, sin /storage/
            $imagenes->save();
        }
    }
}
