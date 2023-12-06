<?php

namespace App\Http\Controllers;

use App\Models\Extraccion;
use Illuminate\Http\Request;
use App\Models\Caja;
use App\Http\Requests\ExtraccionRequest;

class ExtraccionController extends Controller
{
    public function index()
    {
        // Obtener todas las extracciones
        $extracciones = Extraccion::all();

        return view('panel.extraccion.index', compact('extracciones'));
    }

    public function create()
    {
        // Obtener la caja activa
        $cajaActiva = Caja::where('status', 1)->first();

        // Verificar si se encontró una caja activa
        if (!$cajaActiva) {
            // Manejar la situación cuando no hay una caja activa
            // Puedes redirigir a una página de error o realizar alguna otra acción
            return redirect()->route('caja2.create')->with('error', 'No hay cajas activas en este momento.');
        }

        // Pasar la caja activa a la vista del formulario de extracción
        return view('panel.extraccion.create', compact('cajaActiva'));
    }

    // app/Http/Controllers/ExtraccionController.php

    public function store(ExtraccionRequest $request)
    {
        // Validar y almacenar la extracción
        $request->validate([
            'monto' => 'required|numeric|min:0',
            'razon' => 'required|string',
            'caja_id' => 'required|exists:cajas,id',
        ]);
    
        // Crear la extracción
        $extraccion = Extraccion::create([
            'monto' => $request->monto,
            'razon' => $request->razon,
            'caja_id' => $request->caja_id,
        ]);
    
        // Actualizar la columna extraccion en la caja correspondiente
        $caja = Caja::find($request->caja_id);
        $caja->extraccion += $request->monto;
        $caja->save();

        return redirect()->route('extraccion.index')->with('success', 'Extracción realizada exitosamente');
    }

}
