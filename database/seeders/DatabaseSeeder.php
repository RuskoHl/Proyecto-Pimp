<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
Use App\Models\Proveedor;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(RolSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);

        Producto::factory(20)->create();
        Proveedor::factory(20)->create();
    }
}
