<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ProductosController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/plantilla','/layouts/plantilla');



Route::post('/login', function (Request $request) {

    $email = $request->email;
    $password = $request->password;

    if ($email === 'admin' && $password === 'admin') {
        return redirect('/usuarios/ver-usuarios');
    }

    return redirect('/clientes/ver-clientes');

})->name('login.simple');


Route::view('/clientes/crear-clientes',"clientes/clientes-formulario");
Route::view('/clientes/ver-clientes',"clientes/clientes-listado");


Route::view('/usuarios/crear-usuarios',"empleados/empleados-listado");
Route::view('/usuarios/ver-usuarios',"empleados/empleados-formulario");

Route::view('/usuarios/iniciar-sesion',"clientes/iniciar-sesion");
Route::view('/inicio',"layouts/plantilla-principal");

Route::view('/productos/crear-productos',"productos/productos-formulario");
Route::view('/productos/ver-productos',"productos/productos-listado");

//rutas controlador 
Route::get('/admin/index', [AdministradorController::class, 'index']);

Route::get('/productos/index', [ProductosController::class, 'index']);
