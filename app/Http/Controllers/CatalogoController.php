<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Importante importar esto

class CatalogoController extends Controller
{
    public function index()
    {
        $respuesta = Http::get('http://127.0.0.1:8000/api/productos');

        if ($respuesta->successful()) {
            $json = $respuesta->json();
            // ¡Ojo aquí! Navegamos por el JSON: datos -> productos -> data
            $productos = $json['datos']['productos']['data'] ?? [];
        } else {
            $productos = [];
        }

        return view('/catalogo/catalogo', compact('productos')); // Asegúrate de que el nombre de la vista sea el correcto
    }

    // Dentro de app/Http/Controllers/CatalogoController.php

    public function show($id)
    {
        // 1. Le pegamos a tu API, pasándole el ID en la URL
        $respuesta = Http::get('http://127.0.0.1:8000/api/productos/' . $id);

        // 2. Si la API responde con éxito (200 OK)
        if ($respuesta->successful()) {
            $json = $respuesta->json();
            // Según tu ProductosController (Backend), devuelves: 'datos' => $producto
            $producto = $json['datos'];

            // Retornamos la vista (ajusta el nombre del archivo blade si es necesario)
            return view('/detalles/detalles', compact('producto'));
        }

        // Si el producto no existe en la API, redirigimos al catálogo con un error
        return redirect()->route('catalogo.index')->with('error', 'Producto no encontrado');
    }


}