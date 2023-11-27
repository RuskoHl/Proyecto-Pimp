<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CajaRequest;
use App\Models\Caja;
use App\Models\Venta;
use Carbon\Carbon;

use Illuminate\Support\Facades\Log;
class CajaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:lista_productos']);
        
    }
    
    public function index()
    {
        $cajas = Caja::with('ventas')->latest()->get();
        
        $totalMontoFinal = $cajas->sum('monto_final');
        
        $cajas->each(function ($caja) {
            $caja->sumatoriaVentas = $caja->ventas->sum('valor_total');
        });
        $montoFinalAutomatico = $cajas->sum('sumatoriaVentas');
    
        return view('panel.caja.index', compact('cajas', 'montoFinalAutomatico'))->with('totalMontoFinal', $totalMontoFinal);
    }
    

    public function create()
    {
        $caja = new Caja();
        return view('panel.caja.create', compact('caja'));

    }

    public function store(CajaRequest $request)
{
    // Crea una nueva instancia de Caja
    $caja = new Caja();

    // Llena los campos de la caja desde la solicitud
    $caja->fecha_apertura = $request->get('fecha_apertura');
    $caja->monto_inicial = $request->get('monto_inicial');
    $caja->fecha_cierre = $request->get('fecha_cierre');
    $caja->cantidad_ventas = $request->get('cantidad_ventas');

    // Calcula automáticamente el monto_final sumando las ventas
    $ventas = Venta::where('fecha_emision', '>=', $caja->fecha_apertura)
                  ->where('fecha_emision', '<=', $caja->fecha_cierre)
                  ->get();
    $caja->monto_final = $ventas->sum('valor_total');
    
    if ($caja->count() === 1 && (!$caja->monto_final || $caja->monto_final == 0)) {
        $caja->monto_final = Venta::sum('valor_total');
    }
    // Convierte el valor 'status' a un número (0 o 1) según la selección del usuario
    $caja->status = $request->get('status') == 'Abierto' ? 1 : 0;

    // Guarda la caja en la base de datos
    $caja->save();

    $montoFinalAutomatico = $caja->sum('sumatoriaVentas');
   return redirect()
        ->route('caja.index')
        ->with('alert', 'Caja "' . $caja->fecha_apertura . '" agregada exitosamente.')
        ->with('montoFinalAutomatico', $montoFinalAutomatico);
}

    public function show(Caja $caja)
    {
        return view('panel.caja.show', compact('caja'));

    }
    public function edit(Caja $caja)

    {
        $sumatoriaVentas = Venta::sum('valor_total');
        return view('panel.caja.edit', compact('caja','sumatoriaVentas'));

    }
    public function update(CajaRequest $request, Caja $caja)
{
    $caja->fecha_apertura = $request->get('fecha_apertura');
    $caja->monto_inicial = $request->get('monto_inicial');
    $caja->fecha_cierre = $request->get('fecha_cierre');

    // Calcular automáticamente el monto_final sumando el monto_inicial a las ventas
    $ventas = Venta::where('fecha_emision', '>=', $caja->fecha_apertura)
                  ->where('fecha_emision', '<=', $caja->fecha_cierre)
                  ->get();

    $montoVentas = $ventas->sum('valor_total');

    // Agregamos logs para depurar
    info('Monto inicial: ' . $caja->monto_inicial);
    info('Monto ventas: ' . $montoVentas);

    $caja->monto_final = $caja->monto_inicial + $montoVentas;

    // Agregamos logs para depurar
    info('Monto final calculado: ' . $caja->monto_final);
    // Agregamos logs para depurar

    $caja->cantidad_ventas = $request->get('cantidad_ventas');

    // Convierte el valor 'status' a un número (0 o 1) según la selección del usuario
    $caja->status = $request->get('status') == 'Abierto' ? 1 : 0;

    $caja->update();

    return redirect()
        ->route('caja.index')
        ->with('alert', 'Caja "' . $caja->fecha_apertura . '" actualizado exitosamente.');
}



    public function graficoIngresosEgresosCaja()
    {
        // Si se hace una petición AJAX
        if (request()->ajax()) {
            $labels = [];
            $montosIniciales = [];
            $montosFinales = [];
    
            // Obtén todas las cajas ordenadas por fecha de apertura
            $cajas = Caja::orderBy('fecha_apertura')->get();
    
            foreach ($cajas as $caja) {
                $idCaja = $caja->id; // Utiliza el ID de la caja como etiqueta
    
                $labels[] = $idCaja;
                $montosIniciales[] = $caja->monto_inicial;
                $montosFinales[] = $caja->monto_final;
            }
    
            $response = [
                'success' => true,
                'data' => [
                    'labels' => $labels,
                    'iniciales' => $montosIniciales,
                    'finales' => $montosFinales,
                ],
            ];
    
            return json_encode($response);
        }
    
        return view('panel.caja.forms.grafico_egresos');
    }
    
    


    public function graficosCajas()
    {
        // Si se hace una petición AJAX
        if (request()->ajax()) {
            $labels = [];
            $montosFinales = [];
            $montosIniciales = [];
    
            // Obtén todas las cajas ordenadas por fecha de apertura
            $cajas = Caja::with('ventas')->orderBy('fecha_apertura')->get();
    
            foreach ($cajas as $caja) {
                // Utiliza el ID de la caja como label en lugar de la fecha
                $idCaja = $caja->id;
                $labels[] = $idCaja;
    
                // Utiliza el monto inicial de la caja directamente
                $montoInicialCaja = $caja->monto_inicial;
                $montosIniciales[$idCaja] = $montoInicialCaja;
    
                // Utiliza el monto final de la caja directamente
                $montoFinalCaja = $caja->monto_final;
                $montosFinales[$idCaja] = $montoFinalCaja;
            }
    
            $response = [
                'success' => true,
                'data' => [
                    'labels' => $labels,
                    'montosIniciales' => $montosIniciales,
                    'montosFinales' => $montosFinales,
                ],
            ];
    
            return json_encode($response);
        }
    
        return view('panel.caja.forms.graficos_cajas');
    }
    
    

    



    public function destroy(Caja $caja)
    {
        $caja->delete();

        return redirect()
            ->route('caja.index')
            ->with('alert', 'Caja eliminado existosamente.');
    }
}