<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\categorias;
use App\Models\Marcas;
use App\Models\Departamentos;
use App\Models\imagenes;
class ProductosController extends Controller
{
    /**
     * Mostrar listado de productos
     */
    public function index(Request $request)
    {
        $categorias = categorias::all();
        $marcas = Marcas::all();
        $departamentos = Departamentos::all();
        $imagenes = imagenes::all();

        // 1. Consulta base con relación de categoría
        $query = Producto::with('categoria');

        // 2. Filtro por Buscador (Search) - agrupado para no romper otros filtros
        $query->when($request->search, function ($q) use ($request) {
            return $q->where(function ($sub) use ($request) {
                $sub->where('nombre', 'like', '%' . $request->search . '%')
                    ->orWhere('descripcion', 'like', '%' . $request->search . '%');
            });
        });

        // 3. Filtro por Categorías (Array de checkboxes)
        $query->when($request->categories, function ($q) use ($request) {
            return $q->whereIn('categoria_id', $request->categories);
        });

        // 4. Filtro por Precio (Rango)
        $query->when($request->min_price, function ($q) use ($request) {
            return $q->where('precio', '>=', $request->min_price);
        });
        $query->when($request->max_price, function ($q) use ($request) {
            return $q->where('precio', '<=', $request->max_price);
        });

        // 5. Productos por página (por defecto 10)
        $perPage = $request->input('per_page', 10);

        // Total de productos en la base de datos (sin filtro)
        $TotalProductos = Producto::count();

        // Productos filtrados y paginados
        $productos = $query->paginate($perPage)->withQueryString();
        
        return view('productos.productos-listado', compact('productos', 'TotalProductos', 'categorias', 'marcas', 'departamentos', 'imagenes'));
    }

    /**
     * Guardar un nuevo producto
     */
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->existencia = $request->existencia;
        $producto->categoria_id = $request->categoria_id;
        $producto->marca_id = $request->marca_id;
        $producto->departamento_id = $request->departamento_id;
        $producto->save();

        $rutaimg = 'imagenes/productos/default.webp';
        if($request->hasFile('imagen')){
        $rutaimg = $request->file('imagen')->store('imagenes/productos', 'public');
        }
        $imagenes = new imagenes();
        $imagenes->producto_id = $producto->id;
        $imagenes->url_imagen = $rutaimg;
        $imagenes->save();

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

    //guardar imagenes
        public function storeimagen(Request $request)
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
