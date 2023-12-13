<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{
    public function mostrarVehiculos()
    {
        // Realiza la consulta a la tabla 'productos' filtrando por la categoría 'ropa'
        $categoria = '2';
        $productos = Producto::whereHas('categoria', function ($query) use ($categoria) {
            $query->where('categoria_id', $categoria);
        })
        ->with('oferta') // Carga explícitamente la relación 'oferta'
        ->get();
    
        // Pasa los datos filtrados a la vista
        return view('vehiculos', compact('productos'));
    }
}
