<?php

namespace Database\Factories;

use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProveedorFactory extends Factory
{
    public function definition(): array
    {
        $vendedor = User::role(['admin'])->inRandomOrder()->first();

        return [
            'nombre_prov' => $this->faker->sentence(),
            'domicilio_prov' => $this->faker->sentence(),
            'mail_prov' => $this->faker->email(),
            'telefono_prov' => $this->faker->phoneNumber(),
        ];
    }
}
