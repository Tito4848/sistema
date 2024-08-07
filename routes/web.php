<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController;
use Illuminate\Support\Facades\Auth;

// Ruta para la página de bienvenida
Route::get('/', function () {
    return view('auth.login');
});

// Rutas CRUD para empleados
Route::resource('empleados', EmpleadosController::class)->middleware('auth');

// Rutas de autenticación
Auth::routes(['register'=>false,'reset'=>false]);

// Rutas protegidas por middleware de autenticación
Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', [EmpleadosController::class, 'index'])->name('home');
});
