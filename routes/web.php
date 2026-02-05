<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ClientesController;

Route::get('/', function () {
    return view('layouts/plantilla');
});

//plantilla general esta se usa pa to y no se toca, es la vista principal
Route::view('/plantilla','/layouts/plantilla');


//rutas para empleados
Route::get('/empleados', [EmpleadosController::class, 'index']);
Route::get('/empleados/crear-cuenta', [EmpleadosController::class, 'create'] );
Route::post('/empleados/mostrar-cuentas', [EmpleadosController::class, 'store']);


//rutas para clientes
Route::get('/clientes', [ClientesController::class, 'index']);
Route::get('/clientes/crear-cuenta',[ClientesController::class,'create']);
Route::post('/clientes/mostrar-clientes', [ClientesController::class,'store']);


//editar clientes
Route::get('/clientes/{id}/editar', [ClientesController::class,'edit']);
Route::post('/clientes/{id}/actualizar', [ClientesController::class,'update']);

//borrar para clientes
Route::delete('/clientes/{id}', [ClientesController::class,'destroy']);



//editar empleados
Route::get('/empleados/{id}/editar', [EmpleadosController::class,'edit']);
Route::post('/empleados/{id}/actualizar', [EmpleadosController::class,'update']);

//borrar para empleados
Route::delete('/empleados/{id}', [EmpleadosController::class,'destroy']);