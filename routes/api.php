<?php

use App\Http\Controllers\UserSanctumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdministradorController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\RolEmpleadoController;
use App\Http\Controllers\ClienteAuthController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\ImagenesController;
use App\Http\Controllers\PedidoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|--------------------------------------------------------------------------
| pedidos 
|--------------------------------------------------------------------------
*/
// Route::get('/pedidos', [PedidoController::class, 'global']);
Route::get('/pedidos/historial/{cliente_id}', [PedidoController::class, 'index']);
Route::get('/pedidos/{id}', [PedidoController::class, 'show']);
Route::post('/pedidos', [PedidoController::class, 'store']);
Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy']);

/*
   |--------------------------------------------------------------------------
   | productos 
   |--------------------------------------------------------------------------
   */
    
Route::get('/productos', [ProductosController::class, 'index']);
Route::get('/productos/{id}', [ProductosController::class, 'show']);
Route::put('/productos/{id}', [ProductosController::class, 'update']);  
Route::post('/productos', [ProductosController::class, 'store']);
Route::delete('/productos/{id}', [ProductosController::class, 'destroy']);

Route::post('/productos/{id}/imagenes', [ProductosController::class, 'subirImagen']);
/*
|--------------------------------------------------------------------------
| categorias
|--------------------------------------------------------------------------
*/

Route::get('/categorias', [CategoriasController::class, 'index']);
Route::get('/categorias/{id}', [CategoriasController::class, 'show']);
Route::put('/categorias/{id}', [CategoriasController::class, 'update']);
Route::delete('/categorias/{id}', [CategoriasController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| marcas
|--------------------------------------------------------------------------
*/
Route::get('/marcas', [MarcasController::class, 'index']);
Route::get('/marcas/{id}', [MarcasController::class, 'show']);
Route::put('/marcas/{id}', [MarcasController::class, 'update']);
Route::delete('/marcas/{id}', [MarcasController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| departamentos
|--------------------------------------------------------------------------
*/
Route::get('/departamentos', [DepartamentosController::class, 'index']);
Route::get('/departamentos/{id}', [DepartamentosController::class, 'show']);
Route::put('/departamentos/{id}', [DepartamentosController::class, 'update']);
Route::delete('/departamentos/{id}', [DepartamentosController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| imagenes
|--------------------------------------------------------------------------
*/
Route::get('/imagenes', [ImagenesController::class, 'index']);
Route::get('/imagenes/{id}', [ImagenesController::class, 'show']);
Route::put('/imagenes/{id}', [ImagenesController::class, 'update']);
Route::delete('/imagenes/{id}', [ImagenesController::class, 'destroy']);


/*
|--------------------------------------------------------------------------
| ROLES EMPLEADO
|--------------------------------------------------------------------------
*/

Route::get('/empleados/rol-empleados', [RolEmpleadoController::class, 'index']);
Route::get('/empleados/crear-nuevo-rol', [RolEmpleadoController::class, 'create']);
Route::post('/empleados/mostrar-roles', [RolEmpleadoController::class, 'store']);
Route::get('/empleados/tipo-empleado/{id}/editar', [RolEmpleadoController::class, 'edit']);
Route::post('/empleados/tipo-empleado/{id}/actualizar', [RolEmpleadoController::class, 'update']);
Route::delete('/empleados/tipo-empleado/{id}', [RolEmpleadoController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| AUTENTICACION CON SANCTUM
|--------------------------------------------------------------------------
*/

Route::post('/userSanctum/in', [UserSanctumController::class, 'autenticacion'])->name('sanctum.in');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/userSanctum/out', [UserSanctumController::class, 'logout'])->name('sanctum.out');

    /*
    |--------------------------------------------------------------------------
    | EMPLEADOS
    |--------------------------------------------------------------------------
    */

    Route::get('/empleados', [EmpleadosController::class, 'index']);
    Route::post('/empleados', [EmpleadosController::class, 'store']);
    Route::get('/empleados/{id}', [EmpleadosController::class, 'show']);
    Route::put('/empleados/{id}', [EmpleadosController::class, 'update']);
    Route::delete('/empleados/{id}', [EmpleadosController::class, 'destroy']);

});

Route::post('/cliente/login', [ClienteAuthController::class, 'login']);
/*
|--------------------------------------------------------------------------
| CLIENTES
|--------------------------------------------------------------------------
*/

Route::get('/clientes', [ClientesController::class, 'index']);
Route::get('/clientes/{id}', [ClientesController::class, 'show']);
Route::put('/clientes/{id}', [ClientesController::class, 'update']);
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy']);
Route::post('/clientes', [ClientesController::class, 'store']);

Route::middleware('auth:clientes')->group(function () {

    Route::post('/cliente/logout', [ClienteAuthController::class, 'logout']);
    Route::get('/cliente/perfil', [ClienteAuthController::class, 'perfil']);

});

