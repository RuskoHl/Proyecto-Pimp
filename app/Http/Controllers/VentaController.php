<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;

class VentaController extends Controller
{
    public function index(){
        $ventas = Venta::with('productos')->all();
        return view('ventas', compact('ventas'));
    }

    public function create(){
       
    }

    public function store(Request $request){

    }

    public function show(Request $request){

    }
    
    public function edit(Request $request){

    }

    public function update(Request $request){

    }
    public function destroy(Request $request){

    }
}
