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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


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
    Route::post('/clientes', [ClientesController::class, 'store']);

Route::middleware('auth:clientes')->group(function () {

    Route::post('/cliente/logout', [ClienteAuthController::class, 'logout']);

    /*
    |--------------------------------------------------------------------------
    | CLIENTES
    |--------------------------------------------------------------------------
    */

    Route::get('/clientes', [ClientesController::class, 'index']);
    Route::get('/clientes/{id}', [ClientesController::class, 'show']);
    Route::put('/clientes/{id}', [ClientesController::class, 'update']);
    Route::delete('/clientes/{id}', [ClientesController::class, 'destroy']);

});