<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\Caja2Controller;
use App\Http\Controllers\CategoriaController;
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
Route::resource('/cajas2', Caja2Controller::class)->names('caja2');

Route::get('graficos-productos',[ProductoController::class,'graficosProductosxCategoria'])->name('graficos-productos');
Route::get('/panel/cajas2/edit2', 'Caja2Controller@editarCajaConStatus1')->name('panel.caja2.edit2');

Route::resource('/categorias', CategoriaController::class)->names('categoria');
