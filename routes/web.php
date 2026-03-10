<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\RolEmpleadoController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthAdministradorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [AuthAdministradorController::class, 'Formulario'])->name('login');

    Route::get('/iniciar-sesion/formulario', [AuthAdministradorController::class, 'Formulario']);

    Route::post('/iniciar-sesion/login', [AuthAdministradorController::class, 'Login']);

    Route::get('/auth/google', function () {
        return Socialite::driver('google')->stateless()->redirect();
    });

    Route::get('/auth/google/callback', [AuthAdministradorController::class, 'handleGoogleCallback']);

    Route::get('/inicio', [ApiController::class, 'index'])->name('dashboard');

    // Logout
    Route::post('/iniciar-sesion/logout', [AuthAdministradorController::class, 'Logout'])->name('logout');

    // Plantilla
    Route::view('/plantilla', '/layouts/plantilla');

    

/*
    |--------------------------------------------------------------------------
    | EMPLEADOS
    |--------------------------------------------------------------------------
    */

Route::get('/empleados', [EmpleadosController::class, 'index']);
Route::get('/empleados/crear-cuenta', [EmpleadosController::class, 'create']);
Route::post('/empleados/mostrar-cuentas', [EmpleadosController::class, 'store']);
Route::get('/empleados/{id}/editar', [EmpleadosController::class, 'edit']);
Route::post('/empleados/{id}/actualizar', [EmpleadosController::class, 'update']);
Route::delete('/empleados/{id}', [EmpleadosController::class, 'destroy']);

/*
    |--------------------------------------------------------------------------
    | CLIENTES
    |--------------------------------------------------------------------------
    */

Route::get('/clientes', [ClientesController::class, 'index']);
Route::get('/clientes/crear-cuenta', [ClientesController::class, 'create']);
Route::post('/clientes/mostrar-clientes', [ClientesController::class, 'store']);
Route::get('/clientes/{id}/editar', [ClientesController::class, 'edit']);
Route::post('/clientes/{id}/actualizar', [ClientesController::class, 'update']);
Route::delete('/clientes/{id}', [ClientesController::class, 'destroy']);

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