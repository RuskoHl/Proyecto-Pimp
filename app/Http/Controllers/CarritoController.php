<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Illuminate\Http\Request;
use App\Models\Producto;
use Gloudemans\Shoppingcart\Facades\Cart;


class CarritoController extends Controller
{
    public function mostrarCarrito()
    {
        return view('carrito');
    }
    public function agregarAlCarrito($id)
    {
        $producto = Producto::find($id);
        Cart::add([
            'id' => $producto->id,
            'name' => $producto->nombre,
            'qty' => 1, $producto->cantidad,
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
    public function storeCarritoEnBaseDeDatos($identifier)
    {
        // Almacena el carrito actual en la base de datos
        Cart::store($identifier);

        return redirect()->route('carrito.mostrar')->with('success', 'Carrito guardado en la base de datos');
    }

    public function restoreCarritoDesdeBaseDeDatos($identifier)
    {
        // Restaura el carrito desde la base de datos
        Cart::restore($identifier);

        return redirect()->route('carrito.mostrar')->with('success', 'Carrito restaurado desde la base de datos');
    }
}