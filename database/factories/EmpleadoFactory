<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Empleado;
use App\Models\User;

class EmpleadoFactory extends Factory
{
    public function definition(): array
    {
        $empleado = User::role('empleado')->inRandomOrder()->first();

        return [
            'dni' => $this->faker->unique()->numberBetween(10000000, 99999999),
            'nombre' => $this->faker->firstName(),
            'apellido' => $this->faker->lastName(),
            'domicilio' => $this->faker->address(),
            'telefono' => $this->faker->phoneNumber(),
            'correo' => $this->faker->unique()->safeEmail(),
            'user_id' => $empleado ? $empleado->id : null, // Ajusta según tu relación con User
            
        ];
    }
}

