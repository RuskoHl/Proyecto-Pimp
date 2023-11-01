<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccesoriosController extends Controller
{
    public function mostrarAccesorios()
    {
        return view('accesorios');
    }
}
