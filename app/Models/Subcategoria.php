<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subcategoria extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'Subcategorias';

    protected $fillable =[
        'nombre','categoria_id'
    ];

    public function Categoria(){
        return $this->BelongsTo(Categoria::class, 'categoria_id');
    }

}

