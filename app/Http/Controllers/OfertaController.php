<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oferta;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class OfertaController extends Controller
{
    public function index()
    {
        $ofertas = Oferta::all(); // Puedes ajustar esto según tus necesidades
    
        return view('panel.ofertas.index', compact('ofertas'));
    }
    public function index2()
    {
        $ofertas = Oferta::where('status', true) // Solo ofertas activas
            ->get();
    
        return view('ofertas', compact('ofertas'));
    }
    public function create()
    {
        $productos = Producto::all();

        return view('panel.ofertas.create', compact('productos'));
    }

    public function store(Request $request)
    {   
    // Validación de datos
    $request->validate([
        'titulo' => 'required|string',
        'descripcion' => 'required|string',
        'fecha_inicio' => 'required|date',
        'fecha_finalizacion' => 'required|date',
        'monto_descuento' => 'required|numeric',
        'productos' => 'required|array',
    ]);

    // Crear la oferta en la base de datos
    $oferta = Oferta::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'fecha_inicio' => $request->fecha_inicio,
        'fecha_finalizacion' => $request->fecha_finalizacion,
        'monto_descuento' => $request->monto_descuento,
        'status' => true, // Agrega esta línea para establecer un valor predeterminado para el campo status
    ]);

    // Asociar productos a la oferta
    $oferta->productos()->attach($request->productos);

    Producto::whereIn('id', $request->productos)->get()->each(function ($producto) use ($oferta) {
        $producto->update([
            'oferta_id' => $oferta->id,
            'precio_ofertado' => $producto->precio - ($producto->precio * $oferta->monto_descuento / 100),
        ]);
    });

    return redirect()->route('ofertas.index')->with('success', 'Oferta creada exitosamente.');
    }



    public function activate($id)
    {
        $oferta = Oferta::findOrFail($id);
        $oferta->update(['status' => true]);

        return redirect()->route('ofertas.index')->with('success', 'Oferta activada exitosamente.');
    }

    public function deactivate($id)
    {
        $oferta = Oferta::findOrFail($id);
        $oferta->update(['status' => false]);

        return redirect()->route('ofertas.index')->with('success', 'Oferta desactivada exitosamente.');
    }

}