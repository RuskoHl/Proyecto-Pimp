<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class AccesoriosController extends Controller
{
    public function mostrarAccesorios()
    {
        //aca llamar tabla productos y utilizar un compact para filtrar
             // Realiza la consulta a la tabla 'productos' filtrando por la categoría 'ropa'
             $categoria = '3';
             $productos = Producto::whereHas('categoria', function ($query) use ($categoria) {
                 $query->where('categoria_id', $categoria);
             })->get();
     
             // Pasa los datos filtrados a la vista
             return view('accesorios', compact('productos'));
    }
}
