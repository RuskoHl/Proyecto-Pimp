<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    //Nombre de la tabla que se conecta a este Modelo
    protected $table = 'proveedores';

    //Nombre de las columnas que son modificables
    protected $fillable = [
        'nombre_prov',
        'domicilio_prov',
        'mail_prov'
    ];

    // INNER JOIN con la tabla Productos
    // por medio de la FK id_prov

    public function productos() {
        return $this->hasMany(Producto::class, 'id_prov')
    }
}
