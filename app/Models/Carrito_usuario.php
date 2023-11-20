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
        'identificador_carrito','user_id','precio_total'
    ];

    
}