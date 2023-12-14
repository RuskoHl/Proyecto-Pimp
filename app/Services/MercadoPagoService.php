<?php

namespace App\Services;
use App\Models\Carrito_usuario;
use App\Models\Venta;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
class MercadoPagoService
{
    private $accessToken;

    public function __construct()
    {
        $this->accessToken = config('mercadopago.access_token');
        SDK::setAccessToken($this->accessToken);
    }

    public function crearPreferencia($precioTotal)
    {
        info('Iniciando la creación de preferencia.');
    
        // Obtén el carrito del usuario actual (ajusta esto según tu lógica de autenticación/usuario)
       $carritoUsuario = Cart::restore(Auth::user()->name); // Asumiendo una relación de uno a uno llamada "cart"
       
    
        // Verifica si hay un carrito de usuario
        if ($carritoUsuario) {
            // Log::info('Carrito de usuario encontrado: ' , $carritoUsuario);
    
            $item = new Item();
            $item->title = "Mi producto";
            $item->quantity = 1;
            $item->unit_price = $precioTotal;
            // info('Item creado: ' . json_encode($item));
    
            $preference = new Preference();
            $preference->items = [$item];
            // info('Preferencia creada: ' . json_encode($preference));
    
            $preference->notification_url = 'https://f559-2803-9800-9400-432b-b520-270c-d528-d438.ngrok.io/mercadopago/webhook'; // Cambia esto por tu ruta de webhook
            // info('Notification URL asignada: ' . $preference->notification_url);
    
            $sandboxInitPoint = $preference->sandbox_init_point;
            // info('Sandbox Init Point: ' . $sandboxInitPoint);
    
            // info('Redirigiendo al usuario a Mercado Pago.');
    
            // Guarda la preferencia sin asociarla a una venta por ahora
            $preference->save();
    
            // Almacena el ID de la preferencia en la sesión
            session(['preferenciaId' => $preference->id]);
    
            // Redirige al usuario a la página de Mercado Pago
            return $sandboxInitPoint;
        } else {
            // Maneja el caso en que no hay carrito
            info('No se encontró un carrito de usuario.');
            // Puedes redirigir al usuario o manejar la lógica según sea necesario
        }
    }
    
    


    public function obtenerPago($idPago)
    {
        // Utiliza la SDK de Mercado Pago para obtener información sobre el pago
        try {
            // Realiza una solicitud para obtener los detalles del pago
            $payment = \MercadoPago\Payment::find_by_id($idPago);

            // Aquí puedes acceder a la información del pago
            $paymentId = $payment->id;
            $status = $payment->status;
            $amount = $payment->transaction_amount;

            // Implementa la lógica adicional según tus necesidades
            // Puedes actualizar el estado de tu aplicación, enviar correos electrónicos, etc.

            return [
                'payment_id' => $paymentId,
                'status' => $status,
                'amount' => $amount,
                // Agrega más detalles según sea necesario
            ];
        } catch (\Exception $e) {
            // Maneja cualquier excepción que pueda ocurrir al obtener el pago
            return [
                'error' => true,
                'message' => $e->getMessage(),
            ];
        }
    }

}