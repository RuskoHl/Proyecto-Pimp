<?php

namespace App\Services;

use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;

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
        // Crea un item en la preferencia
        $item = new Item();
        $item->title = "Mi producto";
        $item->quantity = 1;
        $item->unit_price = $precioTotal;
    
        $preference = new Preference();
        $preference->items = [$item];
        $preference->save();
    
        // Obtén el URL de inicio del sandbox
        $sandboxInitPoint = $preference->sandbox_init_point;
    
        // Redirige al usuario al sandbox_init_point
        header("Location: $sandboxInitPoint");
        exit();
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