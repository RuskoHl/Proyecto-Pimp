<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory;
    use SoftDeletes;

    //Nombre de la tabla que se conecta a este Modelo
    protected $table = 'proveedors';

    //Nombre de las columnas que son modificables
    protected $fillable = [
        'nombre', 'email', 'telefono', 'direccion', 'cuit', 'comentario'
    ];
}
