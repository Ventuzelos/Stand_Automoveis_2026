<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (! $request->user()) {
            abort(403, 'Utilizador não autenticado.');
        }

        if ($request->user()->role !== $role) {
            abort(403, 'Não tens permissão para aceder a esta área.');
        }

        return $next($request);
    }
}
