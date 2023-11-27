<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create([
            'nombre'=>'Buzo Oversize Negro',
            'descripcion'=>'100% Algodón',
            'precio'=>'5000',
            'imagen'=>'buzo.png',
            'categoria_id'=>'1',
            'cantidad_minima'=>'100',
            'cantidad' => '150',
        ]);
        Producto::create([
            'nombre' => 'Remera Blanca PIMP',
            'descripcion' => 'Diseño moderno y cómodo',
            'precio' => '3500',
            'imagen' => 'remera.png',
            'categoria_id' => '1',
            'cantidad_minima' => '80',
            'cantidad' => '120',
        ]);

        Producto::create([
            'nombre' => 'Pantalón Cargo ',
            'descripcion' => 'Ajuste perfecto y duradero',
            'precio' => '4500',
            'imagen' => 'cargo.png',
            'categoria_id' => '1',
            'cantidad_minima' => '60',
            'cantidad' => '90',
        ]);

        Producto::create([
            'nombre' => 'Zapatillas PIMP',
            'descripcion' => 'Estilo y comodidad para tus actividades deportivas',
            'precio' => '6000',
            'imagen' => 'zapatillas.png',
            'categoria_id' => '1',
            'cantidad_minima' => '70',
            'cantidad' => '100',
        ]);

        Producto::create([
            'nombre' => 'Campera ',
            'descripcion' => 'Última tendencia de la calle',
            'precio' => '2500',
            'imagen' => 'campera.png',
            'categoria_id' => '1',
            'cantidad_minima' => '90',
            'cantidad' => '110',
        ]);



        Producto::create([
            'nombre'=>'Skate PIMP Professional',
            'descripcion'=>'Máxima calidad garantizada con tecnología NeoGomosa',
            'precio'=>'9999',
            'imagen'=>'skate.png',
            'categoria_id'=>'2',
            'cantidad_minima'=>'50',
            'cantidad' => '100',
        ]);
        Producto::create([
            'nombre' => 'Patines en Línea Profesionales',
            'descripcion' => 'Deslízate con estilo y precisión',
            'precio' => '7999',
            'imagen' => 'patines.png',
            'categoria_id' => '2',
            'cantidad_minima' => '40',
            'cantidad' => '80',
        ]);

        Producto::create([
            'nombre' => 'Bicicleta de Montaña',
            'descripcion' => 'Construcción resistente para terrenos difíciles',
            'precio' => '12000',
            'imagen' => 'bicicleta.png',
            'categoria_id' => '2',
            'cantidad_minima' => '30',
            'cantidad' => '60',
        ]);

        Producto::create([
            'nombre' => 'Monopatín Clásico',
            'descripcion' => 'Diversión garantizada en cada paseo',
            'precio' => '2500',
            'imagen' => 'monopatin.pngs',
            'categoria_id' => '2',
            'cantidad_minima' => '50',
            'cantidad' => '90',
        ]);

        Producto::create([
            'nombre' => 'Scooter Plegable',
            'descripcion' => 'Transporte urbano cómodo y práctico',
            'precio' => '3500',
            'imagen' => 'scooter.png',
            'categoria_id' => '2',
            'cantidad_minima' => '20',
            'cantidad' => '40',
        ]);

        Producto::create([
            'nombre'=>'Casco PIMP de fibra de carbono',
            'descripcion'=>'Protección de nivel profesional',
            'precio'=>'2000',
            'imagen'=>'casco.png',
            'categoria_id'=>'3',
            'cantidad_minima'=>'100',
            'cantidad' => '120',
        ]);
        Producto::create([
            'nombre' => 'Guantes Duramax',
            'descripcion' => 'Complementa tu estilo con estos guantes',
            'precio' => '1500',
            'imagen' => 'guantes.png',
            'categoria_id' => '3',
            'cantidad_minima' => '70',
            'cantidad' => '100',
        ]);

        Producto::create([
            'nombre' => 'Riñonera Trappin 97',
            'descripcion' => 'Diseño moderno y espacioso',
            'precio' => '4000',
            'imagen' => 'riñonera.png',
            'categoria_id' => '3',
            'cantidad_minima' => '40',
            'cantidad' => '70',
        ]);

        Producto::create([
            'nombre' => 'Reloj de Pulsera Deportivo',
            'descripcion' => 'Funcionalidad y estilo para tus actividades diarias',
            'precio' => '2800',
            'imagen' => 'reloj.png',
            'categoria_id' => '3',
            'cantidad_minima' => '60',
            'cantidad' => '90',
        ]);

        Producto::create([
            'nombre' => 'Lentes de Protección',
            'descripcion' => 'Protección UV y estilo en un solo accesorio',
            'precio' => '2000',
            'imagen' => 'lentes.png',
            'categoria_id' => '3',
            'cantidad_minima' => '50',
            'cantidad' => '80',
        ]);
    }
    }

