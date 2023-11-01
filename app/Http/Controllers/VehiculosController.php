<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VehiculosController extends Controller
{
    public function mostrarVehiculos()
    {
        return view('vehiculos');
    }
}
