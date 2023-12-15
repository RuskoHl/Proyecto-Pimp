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
    // Obtener el payload del webhook
    $payload = $request->all();

    // Registrar el payload en los logs
    Log::info('Usando handleWebhook : ' . json_encode($payload));

    // Verificar si la clave 'action' o 'topic' está presente en el payload
    if (isset($payload['action']) || isset($payload['topic'])) {
        // Utilizar 'action' o 'topic' según la disponibilidad para determinar el tipo de evento
        $eventType = $payload['action'] ?? $payload['topic'];

        // Realizar acciones según el tipo de evento
        switch ($eventType) {
            case 'payment.created':
                // Verificar si las claves esenciales están presentes en el array 'data'
                if (isset($payload['data']['id'], $payload['data']['date_created'])) {
                    // Las claves esenciales están presentes, puedes continuar con el manejo del evento
                    $paymentId = $payload['data']['id'];
                    $dateCreated = $payload['data']['date_created'];

                    // Realizar acciones específicas para el evento de pago
                    // ...

                    // Registrar información del evento en los logs
                    Log::info("Evento de pago creado - ID: $paymentId, Fecha de Creación: $dateCreated");

                    // Agregar mensaje de log antes y después de llamar a handlePayment
                    Log::info('Antes de llamar a handlePayment');
                    $this->handlePayment($paymentId);
                    Log::info('Después de llamar a handlePayment');
                } else {
                    // Obtener las claves faltantes
                    $missingKeys = array_diff(['id', 'date_created'], array_keys($payload['data']));
                    Log::error('Claves necesarias no encontradas en el payload del evento de pago: ' . json_encode($payload));
                    Log::error('Claves faltantes: ' . implode(', ', $missingKeys));
                }
                break;

            case 'merchant_order':
                // Manejar el evento de la orden del comerciante
                // Obtener información específica de merchant_order según la estructura del payload
                $merchantOrderData = $payload['data'] ?? null;

                if ($merchantOrderData) {
                    // Realizar acciones específicas para el evento de merchant_order
                    // ...
                    
                    // Registrar información del evento en los logs
                    Log::info('Evento de orden del comerciante recibido');
                    Log::info('Datos de la orden del comerciante: ' . json_encode($merchantOrderData));
                } else {
                    // Registro de error si no se encuentra información de la orden del comerciante
                    Log::error('Datos de la orden del comerciante no encontrados en el payload: ' . json_encode($payload));
                }
                break;

            // Agregar casos para otros tipos de eventos si es necesario
            // ...

            default:
                // Manejar otros tipos de eventos si es necesario
                // ...

                // Registrar un aviso en los logs para eventos desconocidos
                Log::warning("Tipo de evento desconocido: $eventType");
                break;
        }
    } else {
        // Registrar un error si no se encuentra 'action' o 'topic' en el payload
        Log::error('Clave "action" o "topic" no encontrada en el payload del webhook: ' . json_encode($payload));
    }

    // Responder a Mercado Pago con un código 200 (OK)
    return response()->json(['status' => 'OK']);
}

private function handlePayment($paymentData)
{
    Log::info('Iniciando handlePayment para el pago ID: ' . $paymentData['id']);

    // Verifica si hay una venta asociada a este pago
    $venta = Venta::where('external_reference', $paymentData['external_reference'] ?? '')->first();

    if (!$venta) {
        // Si no existe, crea una nueva venta con los datos del carrito u otros datos necesarios
        $nuevaVenta = new Venta();
        $nuevaVenta->external_reference = $paymentData['external_reference'] ?? '';
        $nuevaVenta->estado = 'completado';
        // Agrega más campos según sea necesario
        $nuevaVenta->save();

        // Puedes agregar más lógica aquí, como enviar correos electrónicos, notificaciones, etc.
        Log::info('Venta creada para el pago ID ' . $paymentData['id']);
    } else {
        // La venta ya existe, puedes manejar este caso según tus necesidades
        Log::info('La venta ya existe para el pago ID ' . $paymentData['id']);
    }
}

 

}