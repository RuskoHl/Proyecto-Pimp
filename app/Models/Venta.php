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
        'fecha_emision', 'iva', 'valor_total'
    ];

    public function caja()
    {
        return $this->belongsTo(Caja::class, 'caja_id');
    }
    
    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'carrito_id');
    }
    
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    


    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class);
    }

}