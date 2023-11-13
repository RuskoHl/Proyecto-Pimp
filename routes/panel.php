<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CajaController;
use Illuminate\Support\Facades\Route;


Route::get('/', function() {
    return view('panel.index');
});

/*->middleware('role:vendedor', 'role:admin') */
Route::resource('/productos', ProductoController::class)->names('producto');
Route::resource('/proveedors', ProveedorController::class)->names('proveedor');
Route::resource('/cajas', CajaController::class)->names('caja');