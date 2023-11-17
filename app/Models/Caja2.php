<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Caja2 extends Model
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
        'status'
    ];
}
