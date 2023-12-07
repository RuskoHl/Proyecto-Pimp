<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Compra;
use App\Models\Caja;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;


class CompraController extends Controller
{
    public function index()
    {
        // Asegúrate de obtener las cajas según tu lógica
        $cajas = Caja::all();
        
        $proveedores = Proveedor::all();
        $productos = Producto::all();
    
        return view('panel.compra.index', compact('proveedores', 'productos', 'cajas'));
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
        // $caja = Caja::where('status', 1)
        //     ->whereDate('fecha_apertura', '<=', $compra->created_at->toDateString())
        //     ->whereDate('fecha_cierre', '>=', $compra->created_at->toDateString())
        //     ->first();
 
        //    O considerando solo la fecha de apertura
        // Obtener la caja correspondiente a la compra
        $caja = Caja::where('status', 1)
            ->whereDate('fecha_apertura', '<=', now())  // Utilizar now() para obtener la fecha actual
            ->whereNull('fecha_cierre')  // Asegurarse de que no haya fecha de cierre
            ->first();

        if ($caja) {
            $compra->caja_id = $caja->id;
            $compra->save();
        } else {
            return redirect()->route('compra.listado')->with('error', 'No hay una caja abierta. La compra se cargó con caja null.');
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
        $cajas = Caja::all();
        // Verificar si hay una caja abierta con status 1
        $cajaAbierta = Caja::where('status', 1)->first();
        // Si no hay caja abierta, redirigir a la vista 'mostrar-mensaje-caja-cerrada'
        if (!$cajaAbierta) {
            return Redirect::route('mostrar-mensaje-caja-cerrada');
        }

        $proveedores = Proveedor::all();
        return view('panel.compra.index', compact('proveedores', 'cajas'));
    }
 
    public function listadoCompras()
    {
        $compras = Compra::orderBy('created_at', 'desc')->get();
        return view('panel.compra.listado', compact('compras'));
    }
    public function cambiarEstadoEntrega($compraId)
    {
        $compra = Compra::findOrFail($compraId);

        $estadoAnterior = $compra->estatus_entrega;

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
            if ($estadoAnterior) {
                foreach ($compra->productos as $producto) {
                    $producto->decrement('cantidad', $producto->pivot->cantidad);
                }
            }
        }

        return redirect()->route('compra.listado')->with('success', 'Estado de entrega modificado con éxito');
    }

    public function cambiarEstadoCobro($compraId)
    {
        $compra = Compra::findOrFail($compraId);
    
        // Verificar si la compra ya está marcada como cobrada
        if ($compra->estatus_cobro) {
            return redirect()->route('compra.listado')->with('error', 'La compra ya ha sido marcada como cobrada y no puede revertirse.');
        }
    
        // Verificar si el campo caja_id de la compra tiene un valor válido
        if (!$compra->caja_id) {
            return redirect()->route('compra.listado')->with('error', 'La compra no tiene asignada una caja válida.');
        }
    
        // Obtener la caja correspondiente a la compra directamente por el caja_id
        $caja = Caja::find($compra->caja_id);
    
        // Agregamos mensajes de depuración
        // dd($caja);
    
        // Verificar si la caja fue encontrada y está abierta
        if ($caja && $caja->status == 1 && is_null($caja->fecha_cierre)) {
            $caja->extraccion += ($compra->estatus_cobro ? -1 : 1) * $compra->monto_total;
            $caja->save();
        } else {
            // Manejar el caso en el que la caja no fue encontrada, no está abierta o ya está cerrada
            return redirect()->route('compra.listado')->with('error', 'No se pudo encontrar la caja abierta para cargar el monto de extracción');
        }
    
        // Modificar el estado de cobro después de actualizar la extracción
        $compra->estatus_cobro = true;
        $compra->save();
    
        return redirect()->route('compra.listado')->with('success', 'Estado de cobro modificado con éxito');
    }
    

    
    public function mostrarMensajeCajaCerrada()
    {
        return view('panel.compra.mensaje_caja_cerrada');
    }
    // public function mostrarFormularioCompra()
    // {
    // //     // Verificar si hay una caja abierta con status 1
    //     $cajaAbierta = Caja::where('status', 1)->first();
    
    // //     // Si no hay caja abierta, redirigir a la vista 'mostrar-mensaje-caja-cerrada'
    //     if (!$cajaAbierta) {
    //         return redirect()->route('mostrar-mensaje-caja-cerrada');
    //     }
    
    // //     // Pasar la variable $cajaAbierta a la vista
    //     return view('panel.compra.index', compact('cajaAbierta'));
    // }
  
    

    

}