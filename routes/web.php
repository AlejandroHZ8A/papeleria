<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\AdminControlador;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\AdminCreateController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/plantilla','/layouts/plantilla');

Route::post('/login', function (Request $request) {

    $email = $request->email;
    $password = $request->password;

    if ($email === 'admin' && $password === 'admin') {
        return redirect('/admin/index');
    }

    return redirect('/clientes/ver-clientes');

})->name('login.simple');


//Route::view('/clientes/crear-clientes',"clientes/clientes-formulario");
Route::view('/clientes/ver-clientes',"clientes/clientes-listado");


//Route::view('/empleados/crear-empleados',"empleados/empleados-listado");
//Route::view('/empleados/ver-empleados',"empleados/empleados-formulario");

Route::view('/usuarios/iniciar-sesion',"clientes/iniciar-sesion");
Route::view('/inicio',"layouts/plantilla-principal");

Route::view('/productos/crear-productos',"productos/productos-formulario");
Route::view('/productos/ver-productos',"productos/productos-listado");

//rutas controlador de administradores
Route::get('/admin/index', [AdminControlador::class, 'index']);

//rutas para ver y enviar el formulario de registro de los usuarios
Route::get('/usuarios/create',[AdminControlador::class,'create']);
Route::post('/clientes/store', [AdminControlador::class,'store']);


<<<<<<< HEAD
Route::get('/productos/index', [ProductosController::class, 'index']);


//registro de nuevo empleado
Route::get('/empleados/create', [AdminCreateController::class, 'create']);
Route::post('/admin/store', [AdminCreateController::class, 'store']);
=======
// Rutas de productos con controlador
Route::get('/productos/index', [ProductosController::class, 'index'])->name('productos.index');
Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');
Route::put('/productos/{id}', [ProductosController::class, 'update'])->name('productos.update');
Route::delete('/productos/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');
>>>>>>> 48de433 (lista de productos ocn insercion)
