<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class AlertasController extends Controller
{
    $productos = Producto::where('cantidad', '<', 20)->get();

    return view('admin.productos.index', compact('productos'));
}
