<?php

use Illuminate\Support\Facades\Route;

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
    return view('casa');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/casa', [App\Http\Controllers\CasaController::class, 'mostrarCasa'])->name('casa');
Route::get('/ropa', [App\Http\Controllers\RopaController::class, 'mostrarRopa'])->name('ropa');
Route::get('/vehiculos', [App\Http\Controllers\VehiculosController::class, 'mostrarVehiculos'])->name('vehiculos');
Route::get('/accesorios', [App\Http\Controllers\AccesoriosController::class, 'mostrarAccesorios'])->name('accesorios');
//Route::get('/productos', [App\Http\Controllers\ProductoController::class, 'mostrarProducto']);

