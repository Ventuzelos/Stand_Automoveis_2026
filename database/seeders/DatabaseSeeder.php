<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Viatura;
use App\Models\Venda;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::factory(25)->create();
        Viatura::factory(32)->create();

        $clientes = Cliente::all();
        $viaturasVendidas = Viatura::where('vendido', true)->take(4)->get();

        foreach ($viaturasVendidas as $viatura) {
            Venda::create([
                'cliente_id' => $clientes->random()->id,
                'viatura_id' => $viatura->id,
                'data_venda' => now()->subDays(rand(1, 60)),
                'preco_venda' => $viatura->preco,
            ]);
        }
    }
}
