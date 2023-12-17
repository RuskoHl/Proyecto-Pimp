<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\Oferta;
use App\Http\Controllers\MercadoPagoWebhookController;

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

Route::get('/ofertas', function () {
    $ofertas = Oferta::with('productos')->get(); // Asegúrate de cargar los productos relacionados

    return view('ofertas', compact('ofertas'));
})->name('ofertas.index');

// routes\web.php
Route::get('/ofertas', [App\Http\Controllers\OfertaController::class, 'index2'])->name('ofertas');


Auth::routes();

Route::get('/video', function () {
    return view('video');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/casa', [App\Http\Controllers\CasaController::class, 'mostrarCasa'])->name('casa');
Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'mostrarCarrito'])->name('carrito');
Route::get('/ropa', [App\Http\Controllers\RopaController::class, 'mostrarRopa'])->name('ropa');
Route::get('/vehiculos', [App\Http\Controllers\VehiculosController::class, 'mostrarVehiculos'])->name('vehiculos');
Route::get('/accesorios', [App\Http\Controllers\AccesoriosController::class, 'mostrarAccesorios'])->name('accesorios');
Route::get('/detalles', [App\Http\Controllers\DetallesController::class, 'mostrarDetalles'])->name('detalles');
Route::get('/producto/{id}', [App\Http\Controllers\DetallesController::class, 'mostrarProducto'])->name('mostrarProducto');
Route::get('/preventa',[App\Http\Controllers\PreventaController::class,'index'])->name('preventa');
Route::post('/webhooks/mercado-pago', [MercadoPagoWebhookController::class, 'handleWebhook']);

Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'mostrarCarrito'])->name('carrito');
Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'mostrarCarrito'])->name('carrito');
Route::post('/carrito', [App\Http\Controllers\CarritoController::class, 'mostrarCarrito'])->name('carrito');
Route::get('/carrito', [App\Http\Controllers\CarritoController::class, 'mostrarCarrito'])->name('carrito.mostrar');
Route::post('/carrito/agregar/{id}', [App\Http\Controllers\CarritoController::class, 'agregarAlCarrito'])->name('carrito.agregar');
Route::post('/carrito/actualizar/{rowId}', [App\Http\Controllers\CarritoController::class, 'actualizarItem'])->name('carrito.actualizar');
Route::delete('/carrito/remover/{rowId}', [App\Http\Controllers\CarritoController::class, 'removerItem'])->name('carrito.remover');
Route::post('/carrito/crear-carrito-y-redirigir', [App\Http\Controllers\CarritoController::class, 'crearCarritoYRedirigir'])->name('carrito.crearCarritoYRedirigir');
Route::get('/carrito/confirmacion', [App\Http\Controllers\CarritoController::class, 'confirmacionPago'])->name('carrito.confirmacion');
// routes/web.phpRoute::post('/webhooks/mercado-pago', [CarritoController::class, 'manejarWebhookMercadoPago']);
Route::post('/webhooks/mercado-pago', [App\Http\Controllers\CarritoController::class, 'manejarWebhookMercadoPago']);


Route::post('/webhooks/mercado-pago',[App\Http\Controllers\CarritoController::class, 'manejarWebhookMercadoPago']);



Route::post('/carrito/store', [App\Http\Controllers\CarritoController::class, 'storeCarritoEnBaseDeDatos'])->name('carrito.store');
Route::get('/pagina-de-error', [App\Http\Controllers\ErrorController::class, 'paginaDeError'])->name('pagina_de_error');
Route::get('/perfil', [App\Http\Controllers\CarritoController::class, 'perfil'])->name('perfil');
