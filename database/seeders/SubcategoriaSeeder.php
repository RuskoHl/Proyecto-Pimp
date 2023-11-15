<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategoria;
class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Subcategoria::create([
        'nombre' => 'Buzo'

       ]);
       Subcategoria::create([
        'nombre' => 'Skate'

       ]);
    }
}
