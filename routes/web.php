<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/crear_usuario', function(){
    $user = new User();
    $user -> name = 'marcos';
    $user -> email = 'juan.perez@gmail.com';
    $user -> password = Hash::make('juan.perez@gmail.com');
    $user -> save();
    return $user;
});