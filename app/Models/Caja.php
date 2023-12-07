<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Caja extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'Cajas';

    protected $fillable = [
        'fecha_apertura',
        'monto_inicial',
        'fecha_cierre',
        'monto_final',
        'cantidad_ventas',
        'status',
        'extraccion'
    ];
    public function carrito(){
        return $this->hasMany(Carrito_usuario::class, 'carrito_usuario_id');
    }
    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class);
    }
    
    public function compras()
    {
        return $this->hasMany(Compra::class, 'caja_id');
    }

    public function cantidadVentas(): int
    {
        return $this->ventas->count();
    }

}

