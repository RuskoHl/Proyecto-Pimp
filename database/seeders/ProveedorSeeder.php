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
        $proveedor1 = Proveedor::create([
            'nombre' => 'GorllaClub',
            'email' => 'gc@gmail.com',
            'telefono' => '3875696010',
            'direccion' => 'LaBsas',
            'cuit' => '546168464',
            'comentario' => 'Ñañeras',
        ]);

        $proveedor2 = Proveedor::create([
            'nombre' => 'blackrock',
            'email' => 'blackrock@gmail.com',
            'telefono' => '3875696011',
            'direccion' => 'LaLunaOscura',
            'cuit' => '3121231231',
            'comentario' => 'LaLunaOscura',
        ]);

        $proveedor3 = Proveedor::create([
            'nombre' => 'Grifith',
            'email' => 'grifith@gmail.com',
            'telefono' => '3875696012',
            'direccion' => 'LaManoDeDios',
            'cuit' => '31231111300',
            'comentario' => 'Femtho...',
        ]);

        // Modificar la creación del ProductoSeeder para usar los IDs de los proveedores creados
        $this->call(ProductoSeeder::class, [
            'proveedorIds' => [$proveedor1->id, $proveedor2->id, $proveedor3->id],
        ]);
    }
}
