<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Empresa>
 */
class EmpresaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pais' => fake()->country(),
            'nombre_empresa' => fake()->company(),
            'tipo_empresa' => 'General',
            'nit' => fake()->unique()->numerify('#########-#'),
            'telefono' => fake()->phoneNumber(),
            'correo' => fake()->unique()->companyEmail(),
            'cantidad_impuesto' => 19,
            'nombre_impuesto' => 'IVA',
            'moneda' => 'COP',
            'direccion' => fake()->address(),
            'ciudad' => fake()->city(),
            'departamento' => fake()->state(),
            'codigo_postal' => fake()->postcode(),
            'logo' => 'default_logo.png',
        ];
    }
}
