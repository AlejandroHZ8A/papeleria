<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\categorias;
use App\Models\Marcas;
use App\Models\Departamentos;

class ProductosController extends Controller
{
    /**
     * Mostrar listado de productos
     */
    public function index(Request $request)
    {
        $productos = Producto::all();
        $TotalProductos = Producto::count();
        $productos = Producto::with('categoria')->get();


        $categorias = categorias::all();
        $marcas = marcas::all();
        $departamentos = departamentos::all();

        // 1. Iniciamos la consulta base
    $query = Producto::query();

    // 2. Filtro por Buscador (Search)
    $query->when($request->search, function ($q) use ($request) {
        return $q->where('nombre', 'like', '%' . $request->search . '%')
                 ->orWhere('descripcion', 'like', '%' . $request->search . '%');
    });

    // 3. Filtro por Categorías (Array)
    $query->when($request->categories, function ($q) use ($request) {
        // "WhereIn" busca cualquier producto cuyo category_id esté en la lista enviada
        return $q->whereIn('categoria_id', $request->categories);
    });

    // 4. Filtro por Precio (Rango)
    $query->when($request->min_price, function ($q) use ($request) {
        return $q->where('precio', '>=', $request->min_price);
    });
    
    $query->when($request->max_price, function ($q) use ($request) {
        return $q->where('precio', '<=', $request->max_price);
    });

        $productosquery = $query->paginate(12)->withQueryString();
        
        
        return view('productos.productos-listado', compact('productos', 'TotalProductos', 'categorias', 'marcas', 'departamentos', 'productosquery'));
    }

    /**
     * Guardar un nuevo producto
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'existencia' => 'required|integer|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'marca_id' => 'nullable|exists:marcas,id',
            'proveedor_id' => 'nullable|exists:proveedores,id',
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        $producto = Producto::create($validatedData);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente');
    }
           /**
     * Guardar una nueva categoria
     */
    public function storecategoria(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen' => 'nullable|string',
        ]);

        $categoria = Categorias::create($validatedData);

        return redirect()->route('productos.index')
            ->with('success', 'Categoria creada exitosamente');
    }

    /**
     * Actualizar un producto existente
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'existencia' => 'required|integer|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'marca_id' => 'nullable|exists:marcas,id',
            'proveedor_id' => 'nullable|exists:proveedores,id',
            'departamento_id' => 'required|exists:departamentos,id',
        ]);

        $producto->update($validatedData);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Eliminar un producto
     */
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente');
    }
}
