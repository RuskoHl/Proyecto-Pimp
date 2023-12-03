<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Compra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CompraController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        $productos = Producto::all();

        return view('panel.compra.index', compact('proveedores', 'productos'));
    }

    public function obtenerProductos($proveedorId)
    {
        $productos = Producto::where('proveedor_id', $proveedorId)->get();
        return response()->json($productos);
    }
    

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'proveedor' => 'required|exists:proveedors,id',
            'monto_total' => 'required|numeric|min:0.01',
            'cantidad' => 'required|array',
            'cantidad.*' => 'numeric|min:1',
        ]);

        // Obtener datos del formulario
        $proveedorId = $request->input('proveedor');
        $montoTotal = $request->input('monto_total');
        $cantidades = $request->input('cantidad');

        // Crear la compra
        $compra = new Compra([
            'proveedor_id' => $proveedorId,
            'monto_total' => $montoTotal,
        ]);

        $compra->save();

        // Adjuntar solo los productos seleccionados a la compra
        foreach ($cantidades as $productoId => $cantidad) {
            if ($cantidad > 0) { // Verificar si la cantidad es mayor que cero
                $producto = Producto::find($productoId);

                // Validar si el producto existe
                if ($producto) {
                    $compra->productos()->attach($productoId, ['cantidad' => $cantidad]);
                }
            }
        }

        // Redirigir a la vista de compras con un mensaje de éxito
        return redirect()->route('compra.index')->with('success', 'Compra realizada con éxito');
    }

    public function formulario()
    {
        $proveedores = Proveedor::all();
        return view('panel.compra.index', compact('proveedores'));
    }
 
    
}