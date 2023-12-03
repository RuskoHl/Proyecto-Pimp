<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\Caja;
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

        // Asignar la caja a la compra
        $caja = Caja::where('status', 1)
            ->where('fecha_apertura', '<=', $compra->created_at)
            ->where('fecha_cierre', '>=', $compra->created_at)
            ->first();

        if ($caja) {
            $compra->caja_id = $caja->id;
            $compra->save();
        }

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
 
    public function listadoCompras()
    {
        $compras = Compra::orderBy('created_at', 'desc')->get();
        return view('panel.compra.listado', compact('compras'));
    }
    public function cambiarEstadoEntrega($compraId)
    {
        $compra = Compra::findOrFail($compraId);

        // Modificar el estado de entrega
        $compra->estatus_entrega = !$compra->estatus_entrega;
        $compra->save();

        // Realizar acciones adicionales según el estado (puedes personalizar estas acciones)
        if ($compra->estatus_entrega) {
            // Ejemplo: Incrementar la cantidad de productos al recibir la entrega
            foreach ($compra->productos as $producto) {
                $producto->increment('cantidad', $producto->pivot->cantidad);
            }
        } else {
            // Ejemplo: Deshacer acciones al revertir la entrega
            // Puedes agregar lógica según tus necesidades
        }

        return redirect()->route('compra.listado')->with('success', 'Estado de entrega modificado con éxito');
    }

    public function cambiarEstadoCobro($compraId)
    {
        $compra = Compra::findOrFail($compraId);
    
        // Verificar si la compra ya está marcada como cobrada
        if ($compra->estatus_cobro) {
            $caja = Caja::where('status', 1)
                ->where('fecha_apertura', '<=', $compra->created_at)
                ->where('fecha_cierre', '>=', $compra->created_at)
                ->first();
    
            if ($caja) {
                // Resta o suma el monto_total según el estatus_cobro
                $caja->extraccion += ($compra->estatus_cobro ? -1 : 1) * $compra->monto_total;
                $caja->save();
            }
    
            // Modificar el estado de cobro después de actualizar la extracción
            $compra->estatus_cobro = !$compra->estatus_cobro;
            $compra->save();
    
            return redirect()->route('compra.listado')->with('success', 'Estado de cobro modificado con éxito');
        } else {
            // Realizar acciones al cobrar (si es necesario)
            // ...
    
            // Actualizar la columna extraccion en la caja
            $caja = Caja::where('status', 1)
                ->where('fecha_apertura', '<=', $compra->created_at)
                ->where('fecha_cierre', '>=', $compra->created_at)
                ->first();
    
            if ($caja) {
                $caja->extraccion += $compra->monto_total;
                $caja->save();
            }
        }
    
        // Modificar el estado de cobro
        $compra->estatus_cobro = !$compra->estatus_cobro;
        $compra->save();
    
        return redirect()->route('compra.listado')->with('success', 'Estado de cobro modificado con éxito');
    }
    
}