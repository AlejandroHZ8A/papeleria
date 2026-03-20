<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DepartamentosController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ImagenesController;
use App\Http\Controllers\PedidoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// --- Rutas de Pedidos ---
Route::get('/pedidos/historial/{cliente_id}', [PedidoController::class, 'index']);
Route::get('/pedidos/{id}', [PedidoController::class, 'show']);
Route::post('/pedidos', [PedidoController::class, 'store']);
Route::delete('/pedidos/{id}', [PedidoController::class, 'destroy']);
// ------------------------

Route::get('/productos/index', [ProductosController::class, 'index']);

Route::get('/productos/{id}', [ProductosController::class, 'show']);

Route::post('/productos/store', [ProductosController::class, 'store']);

Route::put('/productos/{id}', [ProductosController::class, 'update']);

Route::delete('/productos/{id}', [ProductosController::class, 'destroy']);