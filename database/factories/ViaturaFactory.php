<?php

namespace Database\Factories;

use App\Models\Viatura;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViaturaFactory extends Factory
{
    protected $model = Viatura::class;

    public function definition(): array
    {
        $marcasModelos = [
            ['marca' => 'BMW', 'modelo' => '320d'],
            ['marca' => 'Mercedes', 'modelo' => 'A180'],
            ['marca' => 'Audi', 'modelo' => 'A3'],
            ['marca' => 'Renault', 'modelo' => 'Clio'],
            ['marca' => 'Peugeot', 'modelo' => '208'],
            ['marca' => 'Volkswagen', 'modelo' => 'Golf'],
        ];

        $carro = fake()->randomElement($marcasModelos);

        return [
            'marca' => $carro['marca'],
            'modelo' => $carro['modelo'],
            'matricula' => strtoupper(fake()->bothify('??-##-??')),
            'ano' => fake()->numberBetween(2016, 2024),
            'quilometragem' => fake()->numberBetween(10000, 150000),
            'preco' => fake()->randomFloat(2, 12000, 35000),
            'imagem' => null,
            'combustivel' => fake()->randomElement(['Gasolina', 'Diesel', 'Híbrido']),
            'cor' => fake()->randomElement(['Preto', 'Branco', 'Cinzento', 'Azul', 'Vermelho']),
            'vendido' => fake()->boolean(30),
        ];
    }
}
