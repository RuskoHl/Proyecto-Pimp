<?php
// app/Http/Controllers/ErrorController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function paginaDeError()
    {
        return view('pagina_de_error');
    }
}
