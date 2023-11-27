<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carrito_usuario extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'carrito_usuario';

    protected $fillable =[
        'identificador_carrito','user_id','precio_total','caja_id','venta_id',
    ];
    public function Caja() {
        return $this->belongsTo(Caja::class, 'caja_id');
    }
    public function carritosUsuario()
    {
        return $this->hasMany(Carrito_usuario::class, 'venta_id');
    }
    public function ventas()
    {
    return $this->hasMany(Venta::class, 'carrito_usuario_id');
    }
}