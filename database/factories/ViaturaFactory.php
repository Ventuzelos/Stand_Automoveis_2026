<?php

namespace Database\Factories;

use App\Models\Viatura;
use Illuminate\Database\Eloquent\Factories\Factory;

class ViaturaFactory extends Factory
{
    protected $model = Viatura::class;

    public function definition(): array
    {
        $carros = [
            ['marca' => 'BMW', 'modelo' => '320d', 'imagem' => 'images/viaturas/bmw_1.jpg'],
            ['marca' => 'Mercedes', 'modelo' => 'A180', 'imagem' => 'images/viaturas/mercedes_1.jpg'],
            ['marca' => 'Audi', 'modelo' => 'A3', 'imagem' => 'images/viaturas/audi_1.jpg'],
            ['marca' => 'Renault', 'modelo' => 'Clio', 'imagem' => 'images/viaturas/renault_1.jpg'],
            ['marca' => 'Peugeot', 'modelo' => '208', 'imagem' => 'images/viaturas/peugeot_1.jpg'],
            ['marca' => 'Volkswagen', 'modelo' => 'Golf', 'imagem' => 'images/viaturas/Volkswagen_1.jpg'],
        ];

        $carro = fake()->randomElement($carros);

        return [
            'marca' => $carro['marca'],
            'modelo' => $carro['modelo'],
            'matricula' => strtoupper(fake()->bothify('??-##-??')),
            'ano' => fake()->numberBetween(2016, 2024),
            'quilometragem' => fake()->numberBetween(10000, 150000),
            'preco' => fake()->randomFloat(2, 12000, 35000),
            'imagem' => $carro['imagem'],
            'combustivel' => fake()->randomElement(['Gasolina', 'Diesel', 'Híbrido']),
            'cor' => fake()->randomElement(['Preto', 'Branco', 'Cinzento', 'Azul', 'Vermelho']),
            'vendido' => fake()->boolean(30),
            'descricao' => "Este {$carro['marca']} {$carro['modelo']} encontra-se em excelente estado geral, com manutenção atualizada e pronto para entrega. Uma opção equilibrada para quem procura qualidade, conforto e segurança.",
            'equipamento' => implode("\n", [
                'GPS',
                'Bluetooth',
                'Sensores de estacionamento',
                'Cruise Control',
                'Ar Condicionado',
                'Câmara traseira',
            ]),
        ];
    }
}
