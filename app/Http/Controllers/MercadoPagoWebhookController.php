<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MercadoPagoService;
use Illuminate\Support\Facades\Log;
use App\Models\Venta;

class MercadoPagoWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        

        $payload = $request->all();
        // Dentro de tu controlador de webhook
        Log::info('Webhook recibido: ' . json_encode($payload));

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
    }
    private function handlePayment($paymentId)
    {
        Log::info('Iniciando handlePayment para el pago ID: ' . $paymentId);
        // Utiliza el servicio de Mercado Pago para obtener detalles del pago
        $mercadoPagoService = new MercadoPagoService();
        $informacionPago = $mercadoPagoService->obtenerPago($paymentId);
    
        // Verifica si la obtención de información fue exitosa
        if (!$informacionPago['error']) {
            // Accede a la información del pago
            $paymentData = $informacionPago['data'];
    
            // Implementa la lógica adicional según tus necesidades
            // Por ejemplo, actualiza el estado de la venta en la base de datos
            $venta = Venta::find($paymentData['external_reference']);
            if ($venta) {
                $venta->estado = 'completado';
                $venta->save();
    
                // Puedes agregar más lógica aquí, como enviar correos electrónicos, notificaciones, etc.
            }
        } else {
            // Maneja el caso en que la obtención de información del pago falla
            Log::error('Error al manejar el evento de pago: ' . $informacionPago['message']);
        }
    }
    
}
