<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class RopaController extends Controller
{
    public function mostrarRopa()
    {
        //aca llamar tabla productos y utilizar un compact para filtrar
             // Realiza la consulta a la tabla 'productos' filtrando por la categoría 'ropa'
             $categoria = '1';
             $productos = Producto::whereHas('categoria', function ($query) use ($categoria) {
                 $query->where('categoria_id', $categoria);
             })->get();
     
             // Pasa los datos filtrados a la vista
             return view('ropa', compact('productos'));
    }
    

}
