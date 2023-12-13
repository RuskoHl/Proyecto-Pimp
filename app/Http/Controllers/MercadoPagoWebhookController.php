<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MercadoPagoService;
use Illuminate\Support\Facades\Log;

class MercadoPagoWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        Log::info('Webhook Mercado Pago recibido');
        try {
        $payload = $request->all();

        // Verifica la firma si es necesario (agrega lógica de seguridad)

        // Maneja diferentes tipos de eventos
        switch ($payload['type']) {
            case 'payment':
                $paymentId = $payload['data']['id'];
                // Lógica para manejar el evento de pago
                $this->handlePayment($paymentId);
                break;
            case 'plan':
                $planId = $payload['data']['id'];
                // Lógica para manejar el evento de plan
                break;
            case 'subscription':
                $subscriptionId = $payload['data']['id'];
                // Lógica para manejar el evento de suscripción
                break;
            case 'invoice':
                $invoiceId = $payload['data']['id'];
                // Lógica para manejar el evento de factura
                break;
            case 'point_integration_wh':
                // Lógica para manejar el evento de punto de integración
                break;
            case 'delivery':
                // Lógica para manejar el evento de entrega
                break;
            default:
                // Manejar otros casos según sea necesario
        }

        // Realiza acciones adicionales según sea necesario

        // Devuelve una respuesta para confirmar la recepción de la notificación
        return response()->json(['status' => 'OK']);
    } catch (\Exception $e) {
        Log::error('Error processing Mercado Pago webhook:', ['error' => $e->getMessage()]);
        return response()->json(['error' => 'Error processing webhook'], 500);
    }
    }
    private function handlePayment($paymentId)
    {
        // Lógica para manejar el evento de pago
        // Puedes utilizar el servicio de Mercado Pago para obtener detalles del pago
        $mercadoPagoService = new MercadoPagoService();
        $informacionPago = $mercadoPagoService->obtenerPago($paymentId);

        // Implementa la lógica adicional según tus necesidades
        // Puedes actualizar el estado de tu aplicación, enviar correos electrónicos, etc.

        // Ejemplo: Almacena la información del pago en tu base de datos
        // ...
    }
}
