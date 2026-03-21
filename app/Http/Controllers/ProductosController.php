<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\categorias;
use App\Models\Marcas;
use App\Models\Departamentos;
use App\Models\imagenes;
use Illuminate\Support\Facades\Storage;
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
        $query = Producto::with(['categoria', 'imagenes']);

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

        //return view('productos.productos-listado', compact('productos', 'TotalProductos', 'categorias', 'marcas', 'departamentos', 'imagenes'));
        //api rest     
        $perPage = $request->input('per_page', 10);
        $TotalProductos = Producto::count();
        $productos = $query->paginate($perPage)->withQueryString();
        // 1. TRANSFORMACIÓN: Aplicamos asset() para tener la URL pública completa
        foreach ($productos as $producto) {
            foreach ($producto->imagenes as $imagen) {
                // Convertimos la ruta relativa en una URL completa
                $imagen->url_imagen = asset('storage/' . $imagen->url_imagen);
            }
        }

        // 2. ¡RETORNAMOS LA VISTA, NO EL JSON!
        // Le pasamos todas las variables que la vista necesita con compact()
        return response()->json([
            'resultado' => true,
            'datos' => [
                'productos' => $productos // Laravel automáticamente formatea la paginación
            ]
        ], 200);
    }
    //mostrar un producto por id
    public function show($id)
    {
        $producto = Producto::with(['imagenes', 'categoria', 'marca', 'departamento'])->find($id);

        if (!$producto) {
            return response()->json([
                'resultado' => false,
                'datos' => null,
                'mensaje' => 'No existe ese producto'
            ], 404);
        }

        // Aplicamos asset() a las imágenes de este producto en específico
        foreach ($producto->imagenes as $imagen) {
            $imagen->url_imagen = asset('storage/' . $imagen->url_imagen);
        }

        return response()->json([
            'resultado' => true,
            'datos' => $producto
        ], 200);
    }
    //

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

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nuevaImg = 'producto_' . $producto->id . '_' . time() . '.' . $imagen->getClientOriginalExtension();
            $ruta = $imagen->storeAs('imagenes/productos', $nuevaImg, 'public');

            $producto->imagenes()->create([
                'url_imagen' => $ruta
            ]);
        }

        // Recargamos las imágenes recién guardadas
        $producto->load('imagenes');

        // Convertimos a URL pública para la respuesta
        foreach ($producto->imagenes as $img) {
            $img->url_imagen = asset('storage/' . $img->url_imagen);
        }

        return response()->json([
            'resultado' => true,
            'datos' => $producto,
            'mensaje' => 'Producto creado exitosamente'
        ], 201);
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

        // return redirect()->route('productos.index')
        //    ->with('success', 'Categoria creada exitosamente');
        return response()->json([
            'categoria' => $categoria,
            'message' => 'Categoria creada exitosamente'
        ], 200);
    }

    /**
     * Actualizar un producto existente
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['resultado' => false, 'mensaje' => 'Producto no encontrado'], 404);
        }

        $producto->update($request->only([
            'nombre',
            'descripcion',
            'precio',
            'existencia',
            'categoria_id',
            'marca_id',
            'departamento_id'
        ]));

        if ($request->hasFile('imagen')) {
            // Borrar vieja
            foreach ($producto->imagenes as $imgVieja) {
                Storage::disk('public')->delete($imgVieja->url_imagen);
            }
            $producto->imagenes()->delete();

            // Subir nueva
            $imagen = $request->file('imagen');
            $nuevaImg = 'producto_' . $producto->id . '_' . time() . '.' . $imagen->getClientOriginalExtension();
            $ruta = $imagen->storeAs('imagenes/productos', $nuevaImg, 'public');

            $producto->imagenes()->create([
                'url_imagen' => $ruta
            ]);
        }

        $producto->load('imagenes');

        // Convertimos a URL pública para la respuesta
        foreach ($producto->imagenes as $img) {
            $img->url_imagen = asset('storage/' . $img->url_imagen);
        }

        return response()->json([
            'resultado' => true,
            'datos' => $producto,
            'mensaje' => 'Producto actualizado exitosamente'
        ], 200);
    }

    /**
     * Eliminar un producto
     */
    public function destroy($id)
    {
        // Traemos el producto con sus imágenes
        $producto = Producto::with('imagenes')->findOrFail($id);

        // 1. Destruir las imágenes físicas del disco
        foreach ($producto->imagenes as $imagen) {
            Storage::disk('public')->delete($imagen->url_imagen);
        }

        // 2. Destruir los registros de las imágenes en la base de datos
        $producto->imagenes()->delete();

        // 3. Destruir el producto (Las categorías y marcas se quedan intactas)
        $producto->delete();

        return response()->json([
            'producto' => $producto,
            'message' => 'Producto y sus imágenes eliminados definitivamente'
        ], 200);
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


    public function subirImagen(Request $request, $id)
    {
        // 1. Validamos
        $request->validate([
            'imagen' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $producto = Producto::findOrFail($id);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');

            // 2. Armamos el nombre personalizado que quería tu profe
            // Le agrego time() para que si le cambias la foto no se quede guardada en caché la vieja
            $nuevaImg = 'producto_' . $producto->id . '_' . time() . '.' . $imagen->getClientOriginalExtension();

            // 3. Guardamos la imagen. Esto CREA la carpeta imagenes/productos automáticamente
            $ruta = $imagen->storeAs('imagenes/productos', $nuevaImg, 'public');

            // 4. Guardamos SOLO la ruta relativa en la BD (ej: imagenes/productos/producto_1_170000.jpg)
            $producto->imagenes()->create([
                'url_imagen' => $ruta
            ]);

            return response()->json([
                'mensaje' => 'Imagen subida con éxito',
                // Retornamos la URL completa para que la veas en Postman y confirmes que existe
                'url_completa' => url('storage/' . $ruta)
            ], 201);
        }

        return response()->json(['mensaje' => 'Hubo un error al procesar la imagen'], 400);
    }

}
