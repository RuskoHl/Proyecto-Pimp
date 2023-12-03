<?php
// app/Models/Compra.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Compra extends Model
{
    protected $fillable = [
        'proveedor_id',
        'monto_total',
    ];

    public function caja(): BelongsTo
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }
    // Relación con la tabla de productos
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'compra_producto')
            ->withPivot('cantidad');
    }

    // Relación con la tabla de proveedores
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
}

