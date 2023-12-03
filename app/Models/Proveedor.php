<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'proveedors';

    protected $fillable = [
        'nombre', 'email', 'telefono', 'direccion', 'cuit', 'comentario'
    ];

    public function productos() {
        return $this->hasMany(Producto::class, 'proveedor_id');
    }
}
