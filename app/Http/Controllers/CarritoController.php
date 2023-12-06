<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Caja;
use App\Http\Requests\CarritoRequest;
use App\Models\Carrito_usuario;
use App\Models\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\Venta;
use App\Services\MercadoPagoService;


class CarritoController extends Controller
{
    public function __construct(

        private MercadoPagoService $mercadoPagoService,
    )
    {}
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

    public function agregarAlCarrito(CarritoRequest $request, $id)
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
        $cantidadNueva = request('cantidad');
        $item = Cart::get($rowId); // Obtiene el item actual en el carrito
        $producto = Producto::find($item->id);

        // Verifica si la cantidad nueva supera la cantidad disponible en la base de datos
        if ($cantidadNueva > $producto->cantidad) {
            return back()->with('error', 'No hay suficiente stock disponible para esta cantidad');
        }

        // Actualiza la cantidad en el carrito solo si la validación es exitosa
        Cart::update($rowId, $cantidadNueva);

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

        // Obtiene el usuario autenticado si existe
        $user = Auth::user();

        // Verifica que el usuario esté autenticado antes de continuar
        if (!$user) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para completar esta acción');
        }
    
        // Validar que exista el user_id y caja_id
        if (!$user->id || !$caja) {
            return redirect()->route('pagina_de_error')->with('error', 'No se puede procesar la venta. Falta información requerida.');
        }
    
        // Itera sobre los productos del carrito
        foreach ($carrito as $item) {
            $producto = Producto::find($item->id);
    
            // Verificar que la cantidad del producto sea suficiente
            if (!$producto || $item->qty > $producto->cantidad) {
                return redirect()->route('pagina_de_error')->with('error', 'No hay suficientes existencias para uno o más productos en el carrito.');
            }
    
            // Incrementa la cantidad vendida de cada producto
            $producto->update(['cantidad_vendida' => $producto->cantidad_vendida + $item->qty]);
    
            // Resta la cantidad vendida de la cantidad disponible
            $nuevaCantidad = $producto->cantidad - $item->qty;
    
            // Actualiza la cantidad disponible en el modelo de Producto
            $producto->update(['cantidad' => $nuevaCantidad]);
        }
    
        // Calcula el precio total del carrito
        $precioTotal = Cart::total();

        // Almacena el carrito y la asociación con el usuario en la tabla carrito_usuario
        $carritoUsuarioId = DB::table('carrito_usuario')->insertGetId([
            'identificador_carrito' => $identificadorCarrito,
            'user_id' => $user->id,
            'caja_id' => $caja->id,
            'precio_total' => $precioTotal,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Almacena el contenido del carrito en la base de datos usando el identificador único
        Cart::store($identificadorCarrito);


        

        // Obtiene el contenido del carrito desde la tabla 'shopping_cart'
        $contenidoFromCart = Cart::content()->toJson();

        // Crea una nueva venta
        $venta = new Venta([
            'fecha_emision' => now(),
            'valor_total' => $precioTotal,
            'caja_id' => $caja->id,
            'user_id' => $user->id,
            'contenido' => $contenidoFromCart ? $contenidoFromCart : Cart::content()->toJson(),
            'estado' => 'pendiente',
        ]);

        // Guarda la venta
        $venta->save();

        // Asocia la venta al carrito_usuario
        DB::table('carrito_usuario')->where('id', $carritoUsuarioId)->update(['venta_id' => $venta->id]);

        // Elimina el carrito almacenado
        Cart::destroy($identificadorCarrito);

        // Almacena la información de la venta en la sesión para que esté disponible después de la redirección
        session(['venta' => $venta]);


        // Crea la preferencia de Mercado Pago
        $mercadoPagoService = new MercadoPagoService();
        $preferencia = $mercadoPagoService->crearPreferencia($precioTotal);

        // Redirige al usuario al punto de inicio del sandbox de Mercado Pago
        return redirect($preferencia->sandbox_init_point);
    }


    public function historialCompras()
    {
        // Obtén el usuario autenticado
        $user = Auth::user();
    
        // Obtén las compras del usuario
        $ventas = $user->ventas;
    
        return view('historial_compras', compact('ventas'));
    }
    

    

    
    public function ProductosMasVendidos()
    {
        // Consulta para obtener la cantidad vendida de cada producto
        $productosMasVendidos = Producto::select('id', 'nombre', 'cantidad_vendida')
            ->orderBy('cantidad_vendida', 'desc')
            ->get();
    
        // Puedes enviar los resultados a una vista o realizar alguna otra acción según tus necesidades
        return view('panel.productos_mas_vendidos', ['productosMasVendidos' => $productosMasVendidos]);
    }
    
    
    
    
    
    
    
    
    
    
    
    public function restoreCarritoDesdeBaseDeDatos($identifier)
   {
       Cart::restore($identifier);

       return redirect()->route('carrito.mostrar')->with('success', 'Carrito restaurado desde la base de datos');
   }
   public function mostrarCarrito2()
   {
       // Obtén el identificador del carrito
       $identificadorCarrito = Str::uuid();
   
       // Restaura el carrito desde la base de datos utilizando el identificador
       Cart::restore($identificadorCarrito);
   
       // Obtén el contenido del carrito directamente como un array
       $carrito = Cart::content()->toArray();
   
       // Renderiza la vista con el contenido del carrito
       return view('panel.contenido', ['carrito' => $carrito]);
   }
}