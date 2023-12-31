<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CajaRequest;
use App\Models\Caja;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


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
    $cajas = Caja::with('ventas')->latest('created_at')->get();

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
        $ventas = Venta::whereBetween('fecha_emision', [$caja->fecha_apertura, now()])->get();
        Log::info($ventas);
        // Calcular el monto total de las ventas
        $montoVentas = $ventas->sum('valor_total');
    
        // Obtener el valor de extracción de la caja HERRAMIENTA ARREGLO
        $extraccion = $caja->extraccion;
    
        // Añadir la línea para manejar la extracción correctamente
        $caja->extraccion = $request->get('status') == 'Cerrado' ? $montoVentas : 0;
    
        // Calcular el nuevo monto final de la caja Magia SUPUESTO ARREGLO
        $nuevoMontoFinal = $request->get('monto_inicial') + $montoVentas - $extraccion;
        // $sumatoriaVentas = $ventas->sum('cantidad_ventas'); // Utilizar la columna correcta
        $cantidadVentas = Venta::where('caja_id', $caja->id)->distinct()->count();
        Log::info($cantidadVentas);

        $monto_final = $caja->monto_inicial + $montoVentas - $extraccion;
        Log::info( $montoVentas);
        
        // Establecer automáticamente la fecha de cierre si la caja se está cerrando
        if ($request->get('status') == 'Cerrado' && $caja->status == 1) {
            $caja->fecha_cierre = now();
        }
    
        // Actualizar el monto final y la cantidad de ventas de la caja
        $caja->update([
            'fecha_apertura' => $request->get('fecha_apertura'),
            'monto_inicial' => $request->get('monto_inicial'),
            'cantidad_ventas' => $cantidadVentas, // Actualiza la cantidad de ventas
            'status' => $request->get('status') == 'Cerrado' ? 0 : 1,
            'extraccion' => $extraccion,
            'monto_final' => $monto_final,
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
        // $ventas = Venta::where('fecha_emision', '>=', $caja->fecha_apertura)
        //             ->where('fecha_emision', '<=', $caja->fecha_cierre)
        //             ->get();
        // $caja->monto_final = $request->get('monto_inicial') + $ventas->sum('valor_total');

        // Convierte el valor 'status' a un número (0 o 1) según la selección del usuario
          // Convierte el valor 'status' a un número (0 o 1) según la selección del usuario
          $caja->status= $request->get('status') == 'Abierto' ? 1 : 0;
          $caja->status= $request->get('status');

        // Guarda la caja en la base de datos
        $caja->save();

        // $montoFinalAutomatico = $caja->sum('sumatoriaVentas');

        return redirect()
            ->route('caja.index')
            ->with('alert', 'Caja "' . $caja->fecha_apertura . '" agregada exitosamente.');
            // ->with('montoFinalAutomatico', $montoFinalAutomatico);
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
        $caja = new Caja();
    
        // Pasa $caja y $montoFinalCajaAnterior a la vista
        return view('panel.caja.create', compact('caja', 'montoFinalCajaAnterior'));
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
  
    public function obtenerMontoFinalCajaAnterior()
    {
        $cajaAnterior = Caja::where('status', 0)->latest('fecha_apertura')->first();

        return $cajaAnterior ? $cajaAnterior->monto_final : 0;
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

    
public function cantidadVentasPorCaja()
{
    // Obtener datos de cajas y sus ventas
    $cajasConVentas = Caja::withCount('ventas')->orderBy('fecha_apertura')->get();

    // Preparar datos para el gráfico
    $labels = $cajasConVentas->pluck('id');
    $cantidadVentas = $cajasConVentas->pluck('ventas_count');

    return view('panel.ventas.forms.graficos_ventas', compact('labels', 'cantidadVentas'));
}
public function graficosCajas()
{
    // Obtener datos de cajas
    $labels = [];
    $montosIniciales = [];
    $montosFinales = [];
    // Obtén todas las cajas ordenadas por fecha de apertura
    $cajas = Caja::with('ventas')->orderBy('fecha_apertura')->get();
    foreach ($cajas as $caja) {
        $idCaja = $caja->id;
        $labels[] = $idCaja;
        $montosIniciales[] = $caja->monto_inicial;
        $montosFinales[] = $caja->monto_final;
    }

    // Pasar los datos a la vista
    return view('panel.caja.forms.graficos_cajas', compact('labels', 'montosIniciales', 'montosFinales'));
}
    public function destroy(Caja $caja)
    {
        $caja->delete();

        return redirect()
            ->route('caja.index')
            ->with('alert', 'Caja eliminado existosamente.');
    }
}