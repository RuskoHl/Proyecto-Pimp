<?php

use MercadoPago\SDK;
use MercadoPago\Payment;

// Configura las credenciales de la API de Mercado Pago
SDK::setAccessToken('TEST-6206171210774310-120523-6bbb0f6b15e92a6419915a0a2de9d19e-1578873649');

// Crea una instancia del cliente de pago
$client = new Payment();

// Cuerpo del mensaje con la configuración del pago y la URL de notificación
$body = [
    'transaction_amount' => 100,
    'token' => 'token',
    'description' => 'description',
    'installments' => 1,
    'payment_method_id' => 'visa',
    'notification_url' => 'https://feb2-2803-9800-9400-432b-4d3a-d177-dfd2-e31.ngrok.io/MercadoPagoWebhookController.php',
    'payer' => [
        'email' => 'test@test.com',
        'identification' => [
            'type' => 'CPF',
            'number' => '19119119100'
        ]
    ]
];

// Crea el pago con la configuración proporcionada
$client->create($body);
?>
