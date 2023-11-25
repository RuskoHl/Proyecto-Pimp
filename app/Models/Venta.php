<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'ventas';

    
    protected $fillable= [
        'fecha_emision', 'valor_total','caja_id','user_id','carrito_usuario_id','cliente_id', 
    ];

    public function caja()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }
    
    public function carrito()
    {
        return $this->belongsTo(Carrito_usuario::class, 'carrito_usuario_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}