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
            'nombre_prov'=>'GorllaClub',
            'domicilio_prov'=>'LaLuna',
            'mail_prov'=>'gc@gmail.com'
        ]);

        Proveedor::create([
            'nombre_prov'=>'Thrasher',
            'domicilio_prov'=>'China',
            'mail_prov'=>'trasher@gmail.com'
        ]);
    }
}
