<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    protected $fillable = [
        'monto_descuento', 'fecha_inicio', 'fecha_finalizacion', 'titulo', 'descripcion', 'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }
}
