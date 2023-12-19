<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Caja;
use App\Models\Venta;
class PanelController extends Controller
{
    public function index()
{
    $graficosCajas = $this->graficosCajas();

    return view('panel.index', $graficosCajas);
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

    // Retornar los datos como un array asociativo
    return [
        'labels' => json_encode($labels),
        'montosIniciales' => json_encode($montosIniciales),
        'montosFinales' => json_encode($montosFinales),
    ];
}}