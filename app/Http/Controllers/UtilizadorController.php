<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;

class UtilizadorController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('gerir-utilizadores');

        $search = $request->input('search');

        $utilizadores = User::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('utilizadores.index', compact('utilizadores', 'search'));
    }

    public function create()
    {
        Gate::authorize('gerir-utilizadores');

        return view('utilizadores.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('gerir-utilizadores');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'role' => 'required|in:admin,vendedor',
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        User::create($validated);

        return redirect()->route('utilizadores.index')
            ->with('success', 'Utilizador criado com sucesso!');
    }

    public function show(User $utilizador)
    {
        Gate::authorize('gerir-utilizadores');

        return view('utilizadores.show', compact('utilizador'));
    }

    public function edit(User $utilizador)
    {
        Gate::authorize('gerir-utilizadores');

        return view('utilizadores.edit', compact('utilizador'));
    }

    public function update(Request $request, User $utilizador)
    {
        Gate::authorize('gerir-utilizadores');

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $utilizador->id,
            'role' => 'required|in:admin,vendedor',
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $utilizador->update($validated);

        return redirect()->route('utilizadores.index')
            ->with('success', 'Utilizador atualizado com sucesso!');
    }

    public function destroy(User $utilizador)
    {
        Gate::authorize('gerir-utilizadores');

        if (auth()->id() === $utilizador->id) {
            return redirect()->route('utilizadores.index')
                ->with('error', 'Não podes eliminar o teu próprio utilizador.');
        }

        $utilizador->delete();

        return redirect()->route('utilizadores.index')
            ->with('success', 'Utilizador eliminado com sucesso!');
    }
}
