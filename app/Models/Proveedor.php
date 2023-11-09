<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    //Nombre de la tabla que se conecta a este Modelo
    protected $table = 'proveedors';

    //Nombre de las columnas que son modificables
    protected $fillable = [
        'nombre', 'email', 'telefono', 'direccion', 'cuit', 'comentario'
    ];
}
