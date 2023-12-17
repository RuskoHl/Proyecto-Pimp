<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CasaController extends Controller
{
    public function mostrarCasa()
    {
        $oferta = DB::table('ofertas')
        ->where('status', true) // Asegurarse de que la oferta esté activa
        ->orderByDesc('monto_descuento')
        ->first();

    // Pasar la oferta a la vista
    return view('casa', ['oferta' => $oferta]);
    }
}
