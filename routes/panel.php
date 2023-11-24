<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\Caja2Controller;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\EmpleadoController;
use App\Models\Producto;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('panel.index');
});


// alerta productos escasos
Route::get('/alertas', function() {
    return view('panel.alertas');
});

Route::get('/alertas',[App\Http\Controllers\ProductoController::class, 'alerta'])->name('alerta');

// fin alerta producots


// alerta productos nuevos
Route::get('/ultimos_agregados', function() {
    return view('panel.ultimos_agregados');
});
Route::get('/ultimos_agregados', [ProductoController::class, 'ultimosAgregados'])->name('ultimos.agregados');

// fin alerta producots escaos

Route::group(['middleware' => ['permission:lista_productos']], function () {
    Route::resource('/productos', ProductoController::class)->names('producto');

    Route::get('/', function() {
        return view('panel.index');
    });

});


Route::resource('/proveedors', ProveedorController::class)->names('proveedor');
Route::resource('/cajas', CajaController::class)->names('caja');
 Route::resource('/cajas2', Caja2Controller::class)->names('caja2');

Route::get('graficos-productos',[ProductoController::class,'graficosProductosxCategoria'])->name('graficos-productos');
Route::get('/panel/cajas2/edit2', [ProductoController::class,'editarCajaConStatus1'])->name('panel.caja2.edit2');

Route::resource('/categorias', CategoriaController::class)->names('categoria');
Route::resource('/ventas', VentaController::class)->names('ventas');
Route::resource('/subcategorias', SubcategoriaController::class)->names('subcategoria');

Route::resource('/empleados', EmpleadoController::class)->names('empleado');

Route::get('/mails/form',[MailController::class,'index'])->name('mails.form');
Route::post('/mails/send-mail', [MailController::class, 'sendMail'])->name('mails.send-mail');

Route::get('/exportar-productos-pdf', [ProductoController::class,'exportarProductosPDF'])->name('exportar-productos-pdf');