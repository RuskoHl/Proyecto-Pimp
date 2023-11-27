<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CajaRequest;
use App\Models\Caja;
use App\Models\Venta;
use Carbon\Carbon;
class CajaController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:lista_productos']);
        
    }
    
    public function index()
    {
        $cajas = Caja::with('ventas')->latest()->get();
       
        
        $totalMontoFinal = Caja::sum('monto_final');
        
        $cajas->each(function ($caja) {
            $caja->sumatoriaVentas = $caja->ventas->sum('valor_total');
        });
        $montoFinalAutomatico = $cajas->sum('sumatoriaVentas');



        return view('panel.caja.index', compact('cajas','montoFinalAutomatico'))->with('totalMontoFinal', $totalMontoFinal);;
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
    
        // Calcular automáticamente el monto_final sumando las ventas
        $ventas = Venta::where('fecha_emision', '>=', $caja->fecha_apertura)
                      ->where('fecha_emision', '<=', $caja->fecha_cierre)
                      ->get();
        $caja->monto_final = $ventas->sum('valor_total');
    
        $caja->cantidad_ventas = $request->get('cantidad_ventas');
    
        // Convierte el valor 'status' a un número (0 o 1) según la selección del usuario
        $caja->status = $request->get('status') == 'Abierto' ? 1 : 0;
    
        $caja->update();
    
        return redirect()
            ->route('caja.index')
            ->with('alert', 'Caja "' . $caja->fecha_apertura . '" actualizado exitosamente.');
    }
    public function graficosCajas()
{
    // Si se hace una petición AJAX
    if (request()->ajax()) {
        $labels = [];
        $montosFinales = [];

        $cajas = Caja::all(); // Obtén todas las cajas, puedes ajustar esto según tus necesidades

        foreach ($cajas as $caja) {
            // Asegúrate de que la fecha esté en el formato correcto, puedes ajustar según sea necesario
            $fecha = Carbon::parse($caja->fecha_apertura)->format('Y-m-d');

            // Agrega la fecha al array de etiquetas si aún no está presente
            if (!in_array($fecha, $labels)) {
                $labels[] = $fecha;
            }

            // Agrega el monto final al array de montosFinales correspondiente a la fecha
            $montosFinales[$fecha] = isset($montosFinales[$fecha]) ? $montosFinales[$fecha] + $caja->monto_final : $caja->monto_final;
        }

        // Ordena las fechas
        sort($labels);

        // Organiza los montos finales según las fechas
        $data = [];
        foreach ($labels as $fecha) {
            $data[] = $montosFinales[$fecha] ?? 0;
        }

        $response = [
            'success' => true,
            'data' => [$labels, $data],
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