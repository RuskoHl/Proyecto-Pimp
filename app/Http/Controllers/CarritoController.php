<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Caja;
use App\Models\Carrito_usuario;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class CarritoController extends Controller
{
    public function mostrarCarrito()
    {
        return view('carrito');
    }
    public function show($carritoId)
{
    $carrito = Cart::restore('identifier');
    $productos = $carrito->productos; // Asume que tienes una relación en tu modelo Carrito
    return view('carritos.show', compact('carrito', 'productos'));
}

    public function agregarAlCarrito(Request $request, $id)
    {
        $producto = Producto::find($id);
        Cart::add([
            'id' => $producto->id,
            'name' => $producto->nombre,
            'qty' => $request->cantidad,
            'price' => $producto->precio,
            'options' => ['size' => 'large']
        ]);

        return back()->with('success', 'Producto agregado al carrito con éxito');
    }

    public function actualizarItem($rowId)
    {
        $cantidad = request('cantidad'); 

        Cart::update($rowId, $cantidad);

        return back()->with('success', 'Cantidad actualizada con éxito');
    }

    public function removerItem($rowId)
    {
        Cart::remove($rowId);

        return back()->with('success', 'Producto eliminado del carrito con éxito');
    }


   

    public function storeCarritoEnBaseDeDatos()
    {
        // Obtén el carrito actual
        $carrito = Cart::content();
        // Obtén la caja abierta
        $caja = Caja::where('status', true)->latest()->first();
        // Genera un identificador único para el carrito
        $identificadorCarrito = Str::uuid();
        // Obtiene el ID del usuario autenticado
        $userId = Auth::id();
        // Calcula el precio total del carrito
        $precioTotal = Cart::total();

        // Almacena el carrito y la asociación con el usuario en la tabla carrito_usuario
        $carritoUsuarioId = DB::table('carrito_usuario')->insertGetId([
            'identificador_carrito' => $identificadorCarrito,
            'user_id' => $userId,
            'caja_id' => $caja->id, // Utiliza el ID de la caja abierta
            'precio_total' => $precioTotal,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Almacena el contenido del carrito en la base de datos usando el identificador único
        Cart::store($identificadorCarrito);

        return redirect()->route('preventa')->with('success', 'Carrito guardado en la base de datos');
    }
    
    public function restoreCarritoDesdeBaseDeDatos($identifier)
   {
       Cart::restore($identifier);

       return redirect()->route('carrito.mostrar')->with('success', 'Carrito restaurado desde la base de datos');
   }
}