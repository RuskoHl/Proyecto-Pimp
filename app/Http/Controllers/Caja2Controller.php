<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CajaRequest;
use App\Models\Caja2;
use App\Models\Caja;
use Carbon\Carbon;

class Caja2Controller extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:lista_productos']);
        
    }
    
    public function index()
    {
        $cajas = Caja2::latest()->get();
        return view('panel.caja2.index', compact('cajas'));
    }

    public function create()
    {
        // Recuperar el monto final de la caja anterior
        $montoFinalCajaAnterior = Caja::where('status', 0)->latest('fecha_cierre')->value('monto_final');
    
        // Si no hay caja anterior, asumir un monto predeterminado o manejarlo según tu lógica
        if (!$montoFinalCajaAnterior) {
            $montoFinalCajaAnterior = 0;
        }
    
        // Crear una nueva instancia de Caja
        $caja = new Caja([
            'fecha_apertura' => Carbon::now(), // Establece la fecha actual automáticamente
        ]);
    
        // Pasa $caja y $montoFinalCajaAnterior a la vista
        return view('panel.caja.create', compact('caja', 'montoFinalCajaAnterior'));
    }
    
    public function obtenerMontoFinalCajaAnterior()
    {
        $cajaAnterior = Caja::where('status', 0)->latest('fecha_apertura')->first();

        return $cajaAnterior ? $cajaAnterior->monto_final : 0;
    }
    public function store(CajaRequest $request)
    {
        $caja = new Caja2();

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
    public function show(Caja2 $caja)
    {
        return view('panel.caja.show', compact('caja'));

    }
    // public function edit(Caja2 $caja)
    // {
    //     return view('panel.caja2.edit2', compact('caja'));

    // }
    public function update(CajaRequest $request, Caja2 $caja)
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
            ->route('caja2.index')
            ->with('alert', 'Caja "' .$caja->fecha_apertura. '" actualizado existosamente.');
    }
    public function destroy(Caja2 $caja)
    {
        $caja->delete();

        return redirect()
            ->route('caja2.index')
            ->with('alert', 'Caja eliminado existosamente.');
    }
    public function editarCajaConStatus1()
{
    // Buscar la caja con status = 1
    $caja = Caja2::where('status', 1)->first();

    // Verificar si encontramos una caja con status = 1
    if (!$caja) {
        // Manejar el caso en el que no hay caja con status = 1
        return redirect()->route('panel.caja2.index')->with('error', 'No puedes editar esta caja.');
    }

    return view('panel.caja2.edit2', compact('caja'));
}

    public function mostrarCaja()
    {
        // Realiza la consulta a la tabla 'cajas' filtrando por el status igual a 1
        $status = 1;
        $cajasAbiertas = Caja::where('status', $status)->get();

        // Pasa los datos filtrados a la vista
        return view('panel.caja2.edit2', compact('cajasAbiertas'));
    }
    public function edit($id)
    {   
    // Buscar la caja por ID
    $caja = Caja::find($id);

    // Verificar si la caja tiene status = 1
    if (!$caja || $caja->status != 1) {
        return redirect()->route('panel.caja2.index')->with('error', 'No puedes editar esta caja.');
    }

    return view('panel.caja2.edit', compact('caja'));
}

    
}
