<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AdminControlador;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\AdminCreateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\RolEmpleadoController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\imagenesController;




Route::get('/', function () {
 //   return view('/Inicio');
});

//plantilla general esta se usa pa to y no se toca, es la vista principal
//Route::view('/plantilla','/layouts/plantilla');


//rutas para empleados
Route::get('/empleados', [EmpleadosController::class, 'index']);
Route::get('/empleados/crear-cuenta', [EmpleadosController::class, 'create']);
Route::post('/empleados/mostrar-cuentas', [EmpleadosController::class, 'store']);


//rutas para clientes
Route::get('/clientes', [ClientesController::class, 'index']);
Route::get('/clientes/crear-cuenta', [ClientesController::class, 'create']);
Route::post('/clientes/mostrar-clientes', [ClientesController::class, 'store']);


//editar clientes
Route::get('/clientes/{id}/editar', [ClientesController::class, 'edit']);
Route::post('/clientes/{id}/actualizar', [ClientesController::class, 'update']);

//borrar para clientes
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy']);



//editar empleados
Route::get('/empleados/{id}/editar', [EmpleadosController::class, 'edit']);
Route::post('/empleados/{id}/actualizar', [EmpleadosController::class, 'update']);

//borrar para empleados
Route::delete('/empleados/{id}', [EmpleadosController::class, 'destroy']);


//rutas para tipos de empleado
Route::get('/empleados/rol-empleados', [RolEmpleadoController::class, 'index']);
Route::get('/empleados/crear-nuevo-rol', [RolEmpleadoController::class, 'create']);
Route::post('/empleados/mostrar-roles', [RolEmpleadoController::class, 'store']);

//editar tipo de empleado
Route::get('/empleados/tipo-empleado/{id}/editar', [RolEmpleadoController::class, 'edit']);
Route::post('/empleados/tipo-empleado/{id}/actualizar', [RolEmpleadoController::class, 'update']);

//borrar tipo de empleado
Route::delete('/empleados/tipo-empleado/{id}', [RolEmpleadoController::class, 'destroy']);


//ruta de la api para mostrar informacion
Route::get('/inicio', [ApiController::class, 'index']);

//Route::view('/plantilla','/layouts/plantilla');



//Route::view('/productos/crear-productos',"productos/productos-formulario");
//Route::view('/productos/ver-productos',"productos/productos-listado");


// Rutas de productos con controlador
Route::get('/productos/index', [ProductosController::class, 'index'])->name('productos.index');
Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');
Route::put('/productos/{id}', [ProductosController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');

//rutas para categorias
Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');

//rutas para departamentos
Route::post('/departamentos', [DepartamentosController::class, 'store'])->name('departamentos.store');

//rutas para marcas
Route::post('/marcas', [MarcasController::class, 'store'])->name('marcas.store');

//rutas para imagenes
Route::post('/imagenes', [imagenesController::class, 'store'])->name('imagenes.store');
Route::get('/imagenes', [imagenesController::class, 'index'])->name('imagenes.index');



