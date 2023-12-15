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
    
        // Obtén el carrito del usuario actual directamente desde la base de datos
        $carritoUsuario = Carrito_usuario::where('user_id', Auth::id())->latest()->first();
    
        // Verifica si hay un carrito de usuario
        if ($carritoUsuario) {
            $item = new Item();
            $item->title = "Mi producto";
            $item->quantity = 1;
            $item->unit_price = $precioTotal; // Corrige aquí de 'amount' a 'unit_price'
    
            $preference = new Preference();
            $preference->items = [$item];
    
            $preference->notification_url = 'https://5ea0-2803-9800-9400-432b-b520-270c-d528-d438.ngrok-free.app/webhooks/mercado-pago';
                $preference->back_urls = [
                    'success' => 'http://localhost:8000/casa',
                    'pending' => 'https://c915-2803-9800-9400-432b-b520-270c-d528-d438.ngrok.io/pending',
                    'failure' => 'https://c915-2803-9800-9400-432b-b520-270c-d528-d438.ngrok.io/failure',
                ];
            $preference->save();
                
            // Almacena el ID de la preferencia en la sesión
            session(['preferenciaId' => $preference->id]);
    
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
    // Realiza una solicitud para obtener los detalles del pago
    $payment = \MercadoPago\Payment::find_by_id($idPago);

    // Aquí puedes acceder a la información del pago
    $paymentId = $payment->id;
    $status = $payment->status;
    $amount = $payment->transaction_amount;

    // Implementa la lógica adicional según tus necesidades
    // Puedes actualizar el estado de tu aplicación, enviar correos electrónicos, etc.

    $result = [
        'payment_id' => $paymentId,
        'status' => $status,
        'amount' => $amount,
        // Agrega más detalles según sea necesario
    ];

    // Depurar la información utilizando dd
    dd($result);
}


}