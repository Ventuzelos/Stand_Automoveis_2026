<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'telefone' => '9' . fake()->numberBetween(10000000, 99999999),
            'nif' => fake()->unique()->numberBetween(100000000, 999999999),
            'morada' => fake()->address(),
        ];
    }
}
