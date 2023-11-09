<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable= [
        'nombre', 'descripcion', 'precio', 'imagen', 'categoria_id', 'cantidad'
    ];

    public function categoria() {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function vendedor(){
        return $this->belongsTo(User::class, 'vendedor_id');
    }
}
