<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::define('gerir-utilizadores', function (User $user) {
            return $user->role === 'admin';
        });

        // Gates gerais para UI/dashboard
        Gate::define('gerir-clientes', function (User $user) {
            return in_array($user->role, ['admin', 'vendedor']);
        });

        Gate::define('gerir-viaturas', function (User $user) {
            return in_array($user->role, ['admin', 'vendedor']);
        });

        Gate::define('gerir-vendas', function (User $user) {
            return in_array($user->role, ['admin', 'vendedor']);
        });

        // Gates para viaturas
        Gate::define('ver-viaturas', function (User $user) {
            return in_array($user->role, ['admin', 'vendedor']);
        });

        Gate::define('criar-viaturas', function (User $user) {
            return in_array($user->role, ['admin', 'vendedor']);
        });

        Gate::define('editar-viaturas', function (User $user) {
            return in_array($user->role, ['admin', 'vendedor']);
        });

        Gate::define('eliminar-viaturas', function (User $user) {
            return $user->role === 'admin';
        });

        // Gates para vendas
        Gate::define('ver-vendas', function (User $user) {
            return in_array($user->role, ['admin', 'vendedor']);
        });

        Gate::define('criar-vendas', function (User $user) {
            return in_array($user->role, ['admin', 'vendedor']);
        });

        Gate::define('editar-vendas', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('eliminar-vendas', function (User $user) {
            return $user->role === 'admin';
        });

        // Gates para clientes
        Gate::define('ver-clientes', function (User $user) {
            return in_array($user->role, ['admin', 'vendedor']);
        });

        Gate::define('criar-clientes', function (User $user) {
            return in_array($user->role, ['admin', 'vendedor']);
        });

        Gate::define('editar-clientes', function (User $user) {
            return $user->role === 'admin';
        });

        Gate::define('eliminar-clientes', function (User $user) {
            return $user->role === 'admin';
        });
    }
}
