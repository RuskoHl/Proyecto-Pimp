<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Categoria;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    public function definition(): array
    {
        $vendedor = User::role(['vendedor'])->inRandomOrder()->first();

        $categoria = Categoria::inRandomOrder()->first();

        return [
            'nombre' => $this->faker->sentence(),
            'descripcion' => $this->faker->paragraph(),
            'precio' => $this->faker->randomFloat(2, 2000, 10000),
            'imagen' => $this->faker->imageUrl(640,480),
            'categoria_id' => $categoria->id,
        
            'cantidad' => $this->faker->randomFloat(),
        ];
    }
}
