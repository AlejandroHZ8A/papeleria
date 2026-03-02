<?php

use App\Http\Controllers\UserSanctumController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdministradorController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\RolEmpleadoController;
use App\Http\Controllers\ApiController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::post('/admin/login', [AuthAdministradorController::class, 'Formulario'])->name('login');
// Route::post('/iniciar-sesion/logout', [AuthAdministradorController::class, 'Logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| RUTAS PUBLICAS (SOLO LOGIN)
|--------------------------------------------------------------------------
*/

// Route::middleware('guest:admin')->group(function () {

//     Route::get('/', [AuthAdministradorController::class, 'Formulario'])->name('login');

//     Route::get('/iniciar-sesion/formulario', [AuthAdministradorController::class, 'Formulario']);

//     Route::post('/iniciar-sesion/login', [AuthAdministradorController::class, 'Login']);

//     Route::get('/auth/google', function () {
//         return Socialite::driver('google')->stateless()->redirect();
//     });

//     Route::get('/auth/google/callback', [AuthAdministradorController::class, 'handleGoogleCallback']);
// });


/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (REQUIEREN LOGIN)
|--------------------------------------------------------------------------
*/

// Route::middleware('auth:admin')->group(function () {

//     // Dashboard
//     Route::get('/inicio', [ApiController::class, 'index'])->name('dashboard');

//     // Logout
//     Route::post('/iniciar-sesion/logout', [AuthAdministradorController::class, 'Logout'])->name('logout');

//     // Plantilla
//     Route::view('/plantilla', '/layouts/plantilla');

    
    /*
    |--------------------------------------------------------------------------
    | EMPLEADOS
    |--------------------------------------------------------------------------
    */

    // Route::get('/empleados', [EmpleadosController::class, 'index']);
    // Route::post('/empleados', [EmpleadosController::class, 'store']);
    // Route::get('/empleados/{id}', [EmpleadosController::class, 'show']);
    // Route::put('/empleados/{id}', [EmpleadosController::class, 'update']);
    // Route::delete('/empleados/{id}', [EmpleadosController::class, 'destroy']);


    /*
    |--------------------------------------------------------------------------
    | CLIENTES
    |--------------------------------------------------------------------------
    */

    // Route::get('/clientes', [ClientesController::class, 'index']);
    // Route::post('/clientes', [ClientesController::class, 'store']);
    // Route::get('/clientes/{id}', [ClientesController::class, 'show']);
    // Route::put('/clientes/{id}', [ClientesController::class, 'update']);
    // Route::delete('/clientes/{id}', [ClientesController::class, 'destroy']);
    
    

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

    Route::post('/userSanctum/in',[UserSanctumController::class, 'autenticacion'])->name('sanctum.in');
    

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/userSanctum/out',[UserSanctumController::class, 'logout'])->name('sanctum.out');
        
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


    /*
    |--------------------------------------------------------------------------
    | CLIENTES
    |--------------------------------------------------------------------------
    */

    Route::get('/clientes', [ClientesController::class, 'index']);
    Route::post('/clientes', [ClientesController::class, 'store']);
    Route::get('/clientes/{id}', [ClientesController::class, 'show']);
    Route::put('/clientes/{id}', [ClientesController::class, 'update']);
    Route::delete('/clientes/{id}', [ClientesController::class, 'destroy']);
    
    });