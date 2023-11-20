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
Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'mostrarCarrito'])->name('carrito');
Route::get('/ropa', [App\Http\Controllers\RopaController::class, 'mostrarRopa'])->name('ropa');
Route::get('/vehiculos', [App\Http\Controllers\VehiculosController::class, 'mostrarVehiculos'])->name('vehiculos');
Route::get('/accesorios', [App\Http\Controllers\AccesoriosController::class, 'mostrarAccesorios'])->name('accesorios');
Route::get('/detalles', [App\Http\Controllers\DetallesController::class, 'mostrarDetalles'])->name('detalles');
Route::get('/producto/{id}', [App\Http\Controllers\DetallesController::class, 'mostrarProducto'])->name('mostrarProducto');

Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'mostrarCarrito'])->name('carrito');
Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'mostrarCarrito'])->name('carrito');
Route::post('/carrito', [App\Http\Controllers\CarritoController::class, 'mostrarCarrito'])->name('carrito');
Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
Route::post('/carrito/agregar/{id}', [App\Http\Controllers\CarritoController::class, 'agregarAlCarrito'])->name('carrito.agregar');
Route::post('/carrito/actualizar/{rowId}', [App\Http\Controllers\CarritoController::class, 'actualizarItem'])->name('carrito.actualizar');
Route::delete('/carrito/remover/{rowId}', [App\Http\Controllers\CarritoController::class, 'removerItem'])->name('carrito.remover');
Route::post('/carrito/store', [App\Http\Controllers\CarritoController::class, 'storeCarritoEnBaseDeDatos'])->name('carrito.store');


