<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\AuthClienteController;
use App\Http\Controllers\CarritoController;

// Route::get('/', function () {
//     return view('welcome');
// });


//route::view('/','/productos/productos');


//catalogo
Route::get('/catalogo', [CatalogoController::class, 'index'])->name('catalogo.index');

//inicio
route::view('/', '/inicio/inicio');

//nosotros
route::view('/nosotros', '/nosotros/nosotros');

//contactanos
route::view('/contactanos', '/contactanos/contactanos');

//detalles del pedido
Route::get('/producto/{id}', [CatalogoController::class, 'show'])->name('catalogo.show');


//login
route::view('/login', '/login/login');


//carrito
route::view('/Carrito', '/carrito/carrito');


// ── AUTH ──────────────────────────────────────────
Route::get('/login', [AuthClienteController::class, 'mostrarLogin'])->name('login');
Route::post('/login', [AuthClienteController::class, 'login'])->name('login.post');
Route::get('/registro', [AuthClienteController::class, 'mostrarRegistro'])->name('registro');
Route::post('/registro', [AuthClienteController::class, 'registro'])->name('registro.post');
Route::post('/logout', [AuthClienteController::class, 'logout'])->name('logout');


// ── CARRITO (protegido) ───────────────────────────
Route::middleware('cliente.auth')->group(function () {
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/carrito/vaciar', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
});