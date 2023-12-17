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
use MercadoPago\SDK;
use App\Services\MercadoPagoService;
use MercadoPago\Preference;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Payment\PaymentClient;

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
        $oferta = $producto->oferta()->where('status', true)->first();
        
        if ($oferta) {
            // Utilizar el precio ofertado si está activo
            $precioProducto = $producto->precio_ofertado;
        } else {
            // Utilizar el precio normal
            $precioProducto = $producto->precio;
        }
        
    
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

//FUNCIONA NO BORRAR XD
public function manejarWebhookMercadoPago(Request $request)
{
    $userId = Auth::id();
    Cart::destroy();
    $data = $request->json()->all();

    Log::info('Webhook Data:', ['data' => $data]);
    Log::info('Data all: ' . json_encode($data));
    Log::info('Contenido de la sesión:', ['session' => session()->all()]);

    // Procesa la notificación según el tipo de evento
    if (isset($data['action']) && $data['action'] === 'payment.created') {
        // Verifica si la clave 'data' está presente y es un array
        if (isset($data['data']) && is_array($data['data'])) {
            // Verifica si la clave 'id' está presente en 'data'
            if (isset($data['data']['id'])) {
                $paymentId = $data['data']['id'];

                // Almacena o utiliza $paymentId según tus necesidades
                Log::info('ID del evento de pago:', ['payment_id' => $paymentId]);

                // Maneja la seguridad, por ejemplo, almacenando el token de acceso de Mercado Pago de forma segura (usando variables de entorno)
                $accessToken = 'TEST-6206171210774310-120523-6bbb0f6b15e92a6419915a0a2de9d19e-1578873649';

                // Obtén detalles adicionales del pago utilizando cURL
                $curl = curl_init();
                curl_setopt_array($curl, [
                    CURLOPT_URL => "https://api.mercadopago.com/v1/payments/" . $paymentId,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_HTTPHEADER => [
                        'Content-Type: application/json',
                        'Authorization: Bearer ' . $accessToken,
                    ],
                ]);

                // Ejecuta la solicitud cURL y maneja errores
                $response = curl_exec($curl);

                $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                curl_close($curl);

                Log::info('xd curl: ', [$response]);

                if ($httpCode === 200) {
                    // Procesa la respuesta como sea necesario
                    $paymentDetails = json_decode($response, true);

                    // Validación adicional, asegúrate de que la decodificación fue exitosa
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        Log::error('Error al decodificar la respuesta JSON: ' . json_last_error_msg());
                    } else {
                        // Obtén el precio total
                        $precioTotal = $paymentDetails['transaction_amount'] ?? 0.00;
                        Log::info('PRECIO TOTAL: ', [$precioTotal]);
                        $status = $paymentDetails['status'] ?? '';
                        $metadata = $paymentDetails['metadata']['comprador'] ?? '';
                        Log::info('METADATA UWU: ', [$metadata]);

                        $comprador = $data['data']['metadata']['comprador'] ?? '';

                        Log::info('Estatu bolo UWU: ', [$status]);
                        Log::info('Comprador bolo UWU: ', [$comprador]);

                        // Obtiene la caja más reciente
                        $caja = Caja::where('status', true)->latest()->first();

                        // Obtiene el carrito del usuario
                        $carritoUsuario = Carrito_Usuario::where('user_id', $userId)->first();

                        // Obtiene la última venta
                        $venta = Venta::latest()->first();

                        if ($venta) {
                            // Actualiza los campos necesarios
                            $venta->fecha_emision = now();
                            $venta->valor_total = $precioTotal;

                            $venta->estado = 'aprobado';


                            // Guarda los cambios en la base de datos
                            $venta->save();

                            // Aquí puedes realizar otras acciones después de la actualización
                            Log::info('Venta actualizada para el pago ID ' . $paymentId);
                        } else {
                            Log::error('No se encontró una venta para actualizar.');
                        }
                    }
                } else {
                    Log::error('Error en la solicitud cURL. Código HTTP: ' . $httpCode);
                }
            } else {
                // La clave 'id' no está presente en 'data'
                Log::error('Clave "id" no encontrada en el payload.');
            }
        } else {
            // La clave 'data' no está presente o no es un array
            Log::error('Clave "data" no encontrada o no es un array en el payload.');
        }
    }
}







    public function crearCarritoYRedirigir()
    {
        
        try {
            // Obtén el carrito actual
            $carrito = Cart::content();
             Log::info( ' Carrito obtenido' );
    
            // Obtén la caja abierta
            $caja = Caja::where('status', true)->latest()->first();
            // Log::info( ' Caja obtenida
    
            // Genera un identificador único para el carrito
            $identificadorCarrito = Str::uuid();
             Log::info( 'Identificador de carrito generado' );
    
            // Obtiene el usuario autenticado si existe
            $user = Auth::user();
    
            // Log::info( ' Verificando autenticación del usuario
            if (!$user) {
                Log::error('Usuario no autenticado. Redirigiendo a la página de inicio de sesión.');
                return redirect()->route('login')->with('error', 'Debes iniciar sesión para completar esta acción');
            }
    
             Log::info( 'Usuario autenticado');
    
            // Validar que exista el user_id y caja_id
            if (!$user->id || !$caja) {
                Log::error('Datos de usuario o caja faltantes. No se puede procesar la venta.');
                return redirect()->route('pagina_de_error')->with('error', 'No se puede procesar la venta. Falta información requerida.');
            }
    
            Log::info( ' Datos de usuario y caja validados');
    
            // Itera sobre los productos del carrito
            foreach ($carrito as $item) {
                $producto = Producto::find($item->id);
    
                // Log::info( ' Producto encontrado');
    
                // Verificar si el producto tiene una oferta activa
                if ($producto->oferta && $producto->oferta->status) {
                    // Utilizar el precio ofertado en lugar del precio normal
                    $precioProducto = $producto->precio_ofertado;
                } else {
                    $precioProducto = $producto->precio;
                }
    
                // Log::info( ' Precio del producto verificado');
    
                // Verificar que la cantidad del producto sea suficiente
                if (!$producto || $item->qty > $producto->cantidad) {
                    Log::error('Existencias insuficientes para uno o más productos en el carrito.');
                    return redirect()->route('pagina_de_error')->with('error', 'No hay suficientes existencias para uno o más productos en el carrito.');
                }
    
                // Log::info( ' Existencias verificadas');
    
                // Incrementa la cantidad vendida de cada producto
                $producto->update(['cantidad_vendida' => $producto->cantidad_vendida + $item->qty]);
    
                // Log::info( ' Cantidad vendida actualizada');
    
                // Resta la cantidad vendida de la cantidad disponible
                $nuevaCantidad = $producto->cantidad - $item->qty;
    
                // Log::info( ' Cantidad disponible actualizada');
    
                // Actualiza la cantidad disponible en el modelo de Producto
                $producto->update(['cantidad' => $nuevaCantidad]);
            }
    
            // Log::info( ' Productos actualizados');
    
            // Calcula el precio total del carrito');
            $precioTotal = Cart::total();
    
            // Log::info( ' Precio total calculado');
    
            // Almacena el carrito y la asociación con el usuario en la tabla carrito_usuario
            $carritoUsuarioId = DB::table('carrito_usuario')->insertGetId([
                'identificador_carrito' => $identificadorCarrito,
                'user_id' => $user->id,
                'caja_id' => $caja->id,
                'precio_total' => $precioTotal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            Log::info( ' Carrito almacenado en la base de datos');
    
            // Almacena el contenido del carrito en la base de datos usando el identificador único
            Cart::store($identificadorCarrito);
    
            Log::info( ' Contenido del carrito almacenado');
    
            // Almacena la información del carrito en la sesión para recuperarla en la confirmación del pago
            session(['carritoUsuarioId' => $carritoUsuarioId, 'precioTotal' => $precioTotal]);
    
            Log::info( ' Información del carrito almacenada en la sesión ');

            session(['carritoUsuarioId' => $carritoUsuarioId, 'precioTotal' => $precioTotal]);

            // Almacena el ID del usuario en la sesión (si está autenticado)
            if ($user) {
                session(['userId' => $user->id]);
            }

            Log::info('Información del carrito almacenada en la sesión');
    
            // Crea la preferencia de Mercado Pago
            $mercadoPagoService = new MercadoPagoService();
            try {
                $preferenciaId = $mercadoPagoService->crearPreferencia($precioTotal);
                Log::info('Preferencia de Mercado Pago creada exitosamente. Preferencia ID: ' . $preferenciaId);
                // Almacena el ID de la preferencia en la sesión
                session(['preferenciaId' => $preferenciaId]);
                // Todo ha sido exitoso
                Log::info('Venta procesada exitosamente.');
                // Elimina todos los elementos del carrito
                

                // Imprime el contenido del carrito para verificar que esté vacío
                Log::info('Contenido del carrito después de destruirlo: ' . json_encode(Cart::content()));
            } catch (\Exception $e) {
                // Log del mensaje de error
                Log::error('Error en la creación de preferencia de Mercado Pago: ' . $e->getMessage());
                // Lanza la excepción nuevamente para que se capture en el controlador
                throw $e;
            }
        } catch (\Exception $e) {
            // Log del mensaje de error
            Log::error('Error en la creación de preferencia de Mercado Pago: ' . $e->getMessage());
            // Lanza la excepción nuevamente para que se capture en el controlador
            throw $e;
        }
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
         
                     return view('tu.vista.confirmacion'); // Redirige a tu vista personalizada de confirmación
                 } else {
                     // ... (manejo del caso en que el pago no fue aprobado)
                 }
             }
   

    public function perfil()
    {
        // Obtén el usuario autenticado
        $user = Auth::user();
    
        // Obtén las compras del usuario
        $ventas = $user->ventas->sortByDesc('id');
    
        return view('perfil', compact('ventas'));
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