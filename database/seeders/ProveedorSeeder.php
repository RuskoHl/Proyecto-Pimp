<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedor::create([
            'nombre'=>'GorllaClub',
            'mail'=>'gc@gmail.com',
            'telefono'=>'3875696010',
            'direccion'=>'LaLuna',
            'cuit'=>'546168464',
            'comentario'=>'LaLuna',
        ]);

        Proveedor::create([
            'nombre'=>'Adidas',
            'mail'=>'Adidas@gmail.com',
            'telefono'=>'3875696011',
            'direccion'=>'LaLuna2',
            'cuit'=>'5461684644',
            'comentario'=>'LaLuna2',
        ]);
    }
}
