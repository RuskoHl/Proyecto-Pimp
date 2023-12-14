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
        try {
            // Obtener el payload del webhook
            $payload = $request->all();

            // Registrar el payload en los logs
            Log::info('Webhook Payload: ' . json_encode($payload));

            // Verificar si la clave 'action' o 'topic' está presente en el payload
            if (isset($payload['action']) || isset($payload['topic'])) {
                // Utilizar 'action' o 'topic' según la disponibilidad para determinar el tipo de evento
                $eventType = $payload['action'] ?? $payload['topic'];

                // Realizar acciones según el tipo de evento
                $this->handleEventType($eventType, $payload);

            } else {
                // Registrar un error si no se encuentra 'action' o 'topic' en el payload
                Log::error('Clave "action" o "topic" no encontrada en el payload del webhook: ' . json_encode($payload));
            }

            // Responder a Mercado Pago con un código 200 (OK)
            return response()->json(['status' => 'OK']);
        } catch (\Exception $e) {
            // Manejar excepciones aquí
            Log::error('Error al manejar el webhook: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function handleEventType($eventType, $payload)
    {
        switch ($eventType) {
            case 'payment.created':
                $this->handlePaymentEvent($payload);
                break;

            case 'merchant_order':
                $this->handleMerchantOrderEvent($payload);
                break;

            default:
                Log::warning("Tipo de evento desconocido: $eventType");
                break;
        }
    }

    private function handlePaymentEvent($payload)
    {
        /**
 * Verifica si todas las claves especificadas existen en el array.
 *
 * @param array $keys
 * @param array $array
 * @return bool
 */
function array_keys_exist(array $keys, array $array)
{
    return !array_diff_key(array_flip($keys), $array);
}
        // Verificar si las claves necesarias están presentes en el array 'data'
        $requiredKeys = ['id', 'date_created', 'status', 'amount'];
        if (array_keys_exist($requiredKeys, $payload['data'])) {
            // Manejar el evento de pago aquí
            $paymentId = $payload['data']['id'];
            $dateCreated = $payload['data']['date_created'];
            $status = $payload['data']['status'];
            $amount = $payload['data']['amount'];

            // Realizar acciones específicas para el evento de pago
            // ...

            // Registrar información del evento en los logs
            Log::info("Evento de pago creado - ID: $paymentId, Fecha de Creación: $dateCreated, Estado: $status, Monto: $amount");

            // Llamar a handlePayment
            $this->handlePayment($paymentId);
        } else {
            // Obtener las claves faltantes
            $missingKeys = array_diff($requiredKeys, array_keys($payload['data']));
            Log::error('Claves necesarias no encontradas en el payload del evento de pago: ' . json_encode($payload));
            Log::error('Claves faltantes: ' . implode(', ', $missingKeys));
        }
    }

    private function handleMerchantOrderEvent($payload)
    {
        // Manejar el evento de la orden del comerciante
        // ...

        // Registrar información del evento en los logs
        Log::info('Evento de orden del comerciante recibido');
    }

    private function handlePayment($paymentId)
    {
        try {
            Log::info('Iniciando handlePayment para el pago ID: ' . $paymentId);

            // Utiliza el servicio de Mercado Pago para obtener detalles del pago
            $mercadoPagoService = new MercadoPagoService();
            $informacionPago = $mercadoPagoService->obtenerPago($paymentId);

            // Verifica si la obtención de información fue exitosa
            if (isset($informacionPago['data'])) {
                $paymentData = $informacionPago['data'];

                // Verifica si hay una venta asociada a este pago
                $venta = Venta::where('external_reference', $paymentData['external_reference'])->first();

                if (!$venta) {
                    // Si no existe, crea una nueva venta con los datos del carrito u otros datos necesarios
                    $nuevaVenta = new Venta();
                    $nuevaVenta->external_reference = $paymentData['external_reference'];
                    $nuevaVenta->estado = 'completado';
                    // Agrega más campos según sea necesario
                    $nuevaVenta->save();

                    // Puedes agregar más lógica aquí, como enviar correos electrónicos, notificaciones, etc.
                    Log::info('Venta creada para el pago ID ' . $paymentId);
                } else {
                    // La venta ya existe, puedes manejar este caso según tus necesidades
                    Log::info('La venta ya existe para el pago ID ' . $paymentId);
                }
            } else {
                // Maneja el caso en que la obtención de información del pago falla
                Log::error('Error al manejar el evento de pago: ' . json_encode($informacionPago));
            }
        } catch (\Exception $e) {
            // Manejar excepciones aquí
            Log::error('Error al manejar el pago: ' . $e->getMessage());
        }
    }
}
