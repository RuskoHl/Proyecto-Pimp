<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $table = 'Cajas';

    protected $fillable = [
        'fecha_apertura',
        'monto_inicial',
        'fecha_cierre',
        'monto_final',
        'cantidad_ventas',
        'status'
    ];
}
