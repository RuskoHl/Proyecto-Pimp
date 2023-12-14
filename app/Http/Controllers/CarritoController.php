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
use MercadoPago\Preference;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Redirect;

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
   
    public function agregarAlCarrito(CarritoRequest $request, $id)
    {
        $producto = Producto::find($id);
    
        // Verificar si el producto tiene una oferta activa
        // $oferta = $producto->ofertas->where('status', true)->first();
    
        // if ($oferta) {
        //     // Utilizar el precio ofertado si está activo
        //     $precioProducto = $oferta->pivot->precio_ofertado;
        // } else {
            // Utilizar el precio normal
            $precioProducto = $producto->precio;
        // }
    
        // Asegurarse de que la cantidad sea válida
        $cantidad = max(1, $request->cantidad);
    
        // Depurar para verificar si se está aplicando el precio correcto
        // dd([
        //     'Precio antes de formatear' => $precioProducto,
        //     'Precio formateado' => number_format($precioProducto, 2, '.', '')
        // ]);
    
        // Agregar el producto al carrito
        Cart::add([
            'id' => $producto->id,
            'name' => $producto->nombre,
            'qty' => $cantidad,
            'price' => number_format($precioProducto, 2, '.', ''), // Formatear el precio a dos decimales
            'options' => ['size' => 'large']
        ]);
    
        return back()->with('success', 'Producto agregado al carrito con éxito');
    }


    public function manejarWebhookMercadoPago(Request $request)
    {
        $data = $request->all();
    
        // Realiza la validación de seguridad (puedes comparar la firma, etc.)
        Log::info('Webhook Data:', $data);
        // Procesa la notificación según el tipo de evento
        if ($data['type'] === 'payment') {
            $paymentId = $data['data']['id'];
            $paymentStatus = $data['data']['status'];
    
            // Realiza acciones según el estado del pago (aprobado, rechazado, etc.)
            if ($paymentStatus === 'approved') {
                // Pago aprobado, realiza las acciones necesarias
                // Por ejemplo, actualiza el estado de la venta, crea la factura, etc.
            } else {
                // Maneja otros casos según sea necesario
            }
        }
    
        return response()->json(['status' => 'OK']);
    }
 
    public function crearCarritoYRedirigir()
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
        
            // Verificar si el producto tiene una oferta activa
            if ($producto->oferta && $producto->oferta->status) {
                // Utilizar el precio ofertado en lugar del precio normal
                $precioProducto = $producto->precio_ofertado;
            } else {
                $precioProducto = $producto->precio;
            }
        
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
        
        // Almacena la información del carrito en la sesión para recuperarla en la confirmación del pago
        session(['carritoUsuarioId' => $carritoUsuarioId, 'precioTotal' => $precioTotal]);
        
        // Crea la preferencia de Mercado Pago
        $mercadoPagoService = new MercadoPagoService();
        $preferenciaId = $mercadoPagoService->crearPreferencia($precioTotal);
        $sandboxInitPoint = $mercadoPagoService->crearPreferencia($precioTotal);

        // Almacena el ID de la preferencia en la sesión
        session(['preferenciaId' => $preferenciaId]);
     
        // Redirige al usuario a la página de Mercado Pago
        return redirect($sandboxInitPoint);    
        }


        public function confirmacionPago(Request $request)
        {
            // Recupera la preferencia de Mercado Pago usando el ID proporcionado en la URL
            $preferenciaId = $request->input('preferenciaId');
            $preferencia = \MercadoPago\Preference::get($preferenciaId);
    
            // Aquí puedes utilizar la función obtenerPago para obtener más detalles del pago si es necesario
            $mercadoPagoService = new MercadoPagoService();
            $informacionPago = $mercadoPagoService->obtenerPago($preferenciaId);
    
            // Obtén la información necesaria de la sesión
            $carritoUsuarioId = session('carritoUsuarioId');
            $precioTotal = session('precioTotal');
    
            // Verifica si la confirmación de pago es válida (puedes ajustar esto según la lógica de Mercado Pago)
            if ($request->has('payment_status') && $request->input('payment_status') === 'approved') {
                // Almacena la venta en la base de datos
                $venta = new Venta();
                $venta->carrito_usuario_id = $carritoUsuarioId;
                $venta->precio_total = $precioTotal;
                $venta->informacion_pago = json_encode($informacionPago); // Puedes almacenar la información de pago en formato JSON
    
                // Agrega más campos según sea necesario
                // ...
    
                $venta->save();
                
                return redirect('casa');
            } else {
                // ... (manejo del caso en que el pago no fue aprobado)
            }
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