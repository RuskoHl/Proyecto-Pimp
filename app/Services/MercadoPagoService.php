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
        info('Iniciando la creación de preferencia en MPSERVICES.');

        // Obtén el carrito del usuario actual directamente desde la base de datos
        $carritoUsuario = Carrito_usuario::where('user_id', Auth::id())->latest()->first();

        info($carritoUsuario);
        info('Definido carrito usuario.' . $carritoUsuario);
        // Verifica si hay un carrito de usuario
        if ($carritoUsuario) {
            $item = new Item();
            $item->title = "Producto Pimp";
            $item->quantity = 1;
            $item->unit_price = $precioTotal;
            $item->metadata = ['comprador' => $carritoUsuario->user_id];
            info('Metadata del Item:', ['metadata' => $item->metadata]);
            
            $preference = new Preference();
            $preference->items = [$item];
            

            info('Items.' , $preference->items);
            Log::info('Metadata enviada al Webhook:', ['metadata' => $item->metadata]);
            info('Preferencia completa:', ['preference' => $preference]);
            $preference->notification_url = 'https://f3f2-2803-9800-9400-432b-ec15-5e0a-b6d7-e3cd.ngrok-free.app/webhooks/mercado-pago';
                

            $preference->save();

            // Almacena el ID de la preferencia en la sesión
            session(['preferenciaId' => $preference->id]);
            info('Contenido de la sesión antes de redirigir:', ['session' => session()->all()]);
            $venta = new Venta([
                'fecha_emision' => now(),

                'user_id' => Auth::id(),
                'contenido' => $carritoUsuario->toJson(),
                'caja_id' => $carritoUsuario->caja_id,
            ]);
    
            // Guarda la venta en la base de datos
            $venta->save();
            // Obtén el init point
            $sandboxInitPoint = $preference->sandbox_init_point;
                
            // Redirige al usuario a la página de Mercado Pago
            header("Location:$sandboxInitPoint");
            exit();
        } else {
            // Maneja el caso en que no hay carrito de usuario
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
