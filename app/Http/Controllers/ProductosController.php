<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        $TotalProductos = Producto::count();
        return view('/productos/productos-listado')->with('productos', $productos)->with('TotalProductos', $TotalProductos);
    }
}
