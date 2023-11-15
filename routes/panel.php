<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CajaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('panel.index');
});

Route::group(['middleware' => ['permission:lista_productos']], function () {
    Route::resource('/productos', ProductoController::class)->names('producto');
});

// Ruta para eliminar productos
Route::post('/productos/{producto}', [ProductoController::class, 'destroy'])->name('producto.destroy');

Route::resource('/proveedors', ProveedorController::class)->names('proveedor');
Route::resource('/cajas', CajaController::class)->names('caja');

