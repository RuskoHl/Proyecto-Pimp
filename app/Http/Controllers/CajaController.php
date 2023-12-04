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
    // Obtener todas las cajas con sus ventas relacionadas
    $cajas = Caja::with('ventas')->latest()->get();

    // Calcular el monto final de todas las cajas sumando sus montos finales individuales
    $totalMontoFinal = $cajas->sum('monto_final');

    // Iterar sobre las cajas para calcular la sumatoria de ventas y actualizar el monto final
    foreach ($cajas as $caja) {
        $caja->sumatoriaVentas = $caja->ventas->sum('valor_total');
        // Ajusta el monto final para reflejar lo que está almacenado en la base de datos
        $caja->monto_final = $caja->monto_inicial + $caja->sumatoriaVentas - $caja->extraccion;
    }

    // Calcular el monto final automático sumando las sumatorias de ventas de todas las cajas
    $montoFinalAutomatico = $cajas->sum('monto_final');

    // Renderizar la vista con los datos necesarios
    return view('panel.caja.index', compact('cajas', 'montoFinalAutomatico'))->with('totalMontoFinal', $totalMontoFinal);
    }

    
    public function update(CajaRequest $request, Caja $caja)
    {
        // Obtener las ventas en el rango de fechas de la caja
        $ventas = Venta::whereBetween('fecha_emision', [$caja->fecha_apertura, $caja->fecha_cierre])->get();
    
        // Calcular el monto total de las ventas
        $montoVentas = $ventas->sum('valor_total');
    
        // Obtener el valor de extracción de la caja
        $extraccion = $caja->extraccion;
    
        // Calcular el nuevo monto final de la caja
        $nuevoMontoFinal = $request->get('monto_inicial') + $montoVentas - $extraccion;
    
        // Mostrar información de depuración
// Mostrar información de depuración
Log::info('Monto Inicial:', ['monto_inicial' => $request->get('monto_inicial')]);
Log::info('Monto Ventas:', ['monto_ventas' => $montoVentas]);
Log::info('Extracción:', ['extraccion' => $extraccion]);
Log::info('Nuevo Monto Final:', ['nuevo_monto_final' => $nuevoMontoFinal]);

    
        // Actualizar el monto final de la caja
        $caja->update([
            'monto_final' => $nuevoMontoFinal,
            'fecha_apertura' => $request->get('fecha_apertura'),
            'monto_inicial' => $request->get('monto_inicial'),
            'fecha_cierre' => $request->get('fecha_cierre'),
            'cantidad_ventas' => $request->get('cantidad_ventas'),
            'status' => $request->get('status') == 'Abierto' ? 1 : 0,
            'extraccion' => $extraccion - $montoVentas, // Restar el monto total de las ventas al valor de extracción
        ]);
    
        // Redireccionar a la vista de índice de cajas con un mensaje de éxito
        return redirect()->route('caja.index')->with('alert', 'Caja "' . $caja->fecha_apertura . '" actualizado exitosamente.');
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
    $caja->monto_final = $request->get('monto_inicial') + $ventas->sum('valor_total');

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

    
    public function create()
    {
        $caja = new Caja();
        return view('panel.caja.create', compact('caja'));

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