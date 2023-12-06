<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extraccion extends Model
{
    use HasFactory;

    protected $table = 'extracciones'; // Nombre de la tabla en la base de datos

    // En el modelo Extraccion.php
    protected $fillable = ['monto', 'razon', 'caja_id'];


    // Si tienes campos de fecha, puedes especificar su formato
    protected $dates = [
        'created_at',
        'updated_at',
        // Agrega aquí otros campos de fecha si los tienes
    ];
    // app/Models/Extraccion.php

    public function caja()
    {
        return $this->belongsTo(Caja::class);
    }

}
