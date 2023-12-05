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
    

    public function obtenerPago()
    {
        // Lógica para obtener información del pago si es necesario
    }
}