<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empleado extends Model
{
    use HasFactory;
    use SoftDeletes;

    //Nombre de la tabla que se conecta a este Modelo
    protected $table = 'empleados';

    //Nombre de las columnas que son modificables
    protected $fillable = [
        'dni', 'nombre', 'apellido', 'domicilio', 'telefono', 'correo', 'created_at',
        'updated_at'
    ];
}