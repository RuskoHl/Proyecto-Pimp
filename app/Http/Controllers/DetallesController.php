<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class DetallesController extends Controller
{
    public function mostrarDetalles()
{
    return view('detalles');
}
public function mostrarProducto($id)
{
    $producto = Producto::find($id);

    return view('detalles', ['producto' => $producto]);
}
}