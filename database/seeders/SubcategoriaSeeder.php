<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategoria;
class SubcategoriaSeeder extends Seeder
{

  public function run(): void{Subcategoria::create(['nombre' => 'Buzo','categoria_id' => 1,]);Subcategoria::create(['nombre' => 'Pantalon','categoria_id' => 1,]);

       Subcategoria::create([
        'nombre' => 'Skate',
        'categoria_id' => 2,

       ]);
       Subcategoria::create([
        'nombre' => 'BMX',
        'categoria_id' => 2,

       ]);
       Subcategoria::create([
        'nombre' => 'Guantes',
        'categoria_id' => 3,

       ]);
       Subcategoria::create([
        'nombre' => 'Casco',
        'categoria_id' => 3,

       ]);
    }
}