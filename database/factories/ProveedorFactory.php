<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Proveedor;
use App\Models\User;



/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProveedorFactory extends Factory
{
    public function definition(): array
    {
        $vendedor = User::role(['vendedor'])->inRandomOrder()->first();


        return [
            'nombre' => $this->faker->sentence(),
            'email' => $this->faker->email(),
            'telefono' => $this->faker->phoneNumber(),
            'direccion' => $this->faker->sentence(),
            'cuit' => $this->faker->randomNumber(),
            'comentario' => $this->faker->sentence(),
        ];
    }
}
