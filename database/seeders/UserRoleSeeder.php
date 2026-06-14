<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@standautomoveis.pt'],
            [
                'name' => 'Administrador',
                'email' => 'admin@standautomoveis.pt',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        User::updateOrCreate(
            ['email' => 'vendedor@standautomoveis.pt'],
            [
                'name' => 'Vendedor',
                'email' => 'vendedor@standautomoveis.pt',
                'password' => Hash::make('password'),
                'role' => 'vendedor',
                'email_verified_at' => now(),
            ]
        );
    }
}
