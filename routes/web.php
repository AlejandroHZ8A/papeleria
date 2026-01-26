<?php

use Illuminate\Http\Request;

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
