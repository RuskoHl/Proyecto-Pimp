<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CajaRequest;
use App\Models\Caja;

class CajaController extends Controller
{
    public function index()
    {
        $cajas = Caja::latest()->get();
        return view('panel.caja.index', compact('cajas'));
    }

    public function create()
    {
        $caja = new Caja();
        return view('panel.caja.create', compact('caja'));

    }

    public function store(CajaRequest $request)
    {
        $caja = new Caja();

        $caja->fecha_apertura= $request->get('fecha_apertura');
        $caja->monto_inicial= $request->get('monto_inicial');
        $caja->fecha_cierre= $request->get('fecha_cierre');       
        $caja->monto_final= $request->get('monto_final');
        $caja->cantidad_ventas= $request->get('cantidad_ventas');
        // Convierte el valor 'status' a un número (0 o 1) según la selección del usuario
        $caja->status= $request->get('status') == 'Abierto' ? 1 : 0;
        $caja->status= $request->get('status');
   

        
        $caja->save();

        return redirect()
                ->route('caja.index')
                ->with('alert', 'caja "' . $caja->fecha_apertura . '" agregado exitosamente.');
    }
    public function show(Caja $caja)
    {
        return view('panel.caja.show', compact('caja'));

    }
    public function edit(Caja $caja)
    {
        return view('panel.caja.edit', compact('caja'));

    }
    public function update(CajaRequest $request, Caja $caja)
    {
        $caja->fecha_apertura= $request->get('fecha_apertura');
        $caja->monto_inicial= $request->get('monto_inicial');
        $caja->fecha_cierre= $request->get('fecha_cierre');              
        $caja->monto_final= $request->get('monto_final');
        $caja->cantidad_ventas= $request->get('cantidad_ventas');
        // Convierte el valor 'status' a un número (0 o 1) según la selección del usuario
        $caja->status= $request->get('status') == 'Abierto' ? 1 : 0;
        $caja->status= $request->get('status');
   



        $caja->update();

        return redirect()
            ->route('caja.index')
            ->with('alert', 'Caja "' .$caja->fecha_apertura. '" actualizado existosamente.');
    }
    public function destroy(Caja $caja)
    {
        $caja->delete();

        return redirect()
            ->route('caja.index')
            ->with('alert', 'Caja eliminado existosamente.');
    }
}
