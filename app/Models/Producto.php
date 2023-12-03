<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
 

class Producto extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'productos';

    protected $fillable= [
        'nombre', 'descripcion', 'precio', 'imagen', 'categoria_id', 'cantidad_minima', 'cantidad' ,'cantidad_vendida'
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
    public function compras()
    {
        return $this->belongsToMany(Compra::class)->withPivot('cantidad');
    }
    
   
}
