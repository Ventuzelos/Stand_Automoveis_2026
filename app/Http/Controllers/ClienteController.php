<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('ver-clientes');

        $search = $request->input('search');

        $clientes = Cliente::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nome', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('telefone', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('clientes.index', compact('clientes', 'search'));
    }

    public function create()
    {
        Gate::authorize('criar-clientes');

        return view('clientes.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('criar-clientes');

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email',
            'telefone' => 'required|string|max:20',
            'nif' => 'required|string|max:20|unique:clientes,nif',
            'morada' => 'required|string|max:155',
        ]);

        Cliente::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'nif' => $request->nif,
            'morada' => $request->morada,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente criado com sucesso!');
    }

    public function show(Cliente $cliente)
    {
        Gate::authorize('ver-clientes');

        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        Gate::authorize('editar-clientes');

        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        Gate::authorize('editar-clientes');

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefone' => 'required|string|max:20',
            'nif' => 'required|string|max:20|unique:clientes,nif,' . $cliente->id,
            'morada' => 'required|string|max:255',
        ]);

        $cliente->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'telefone' => $request->telefone,
            'nif' => $request->nif,
            'morada' => $request->morada,
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente)
    {
        Gate::authorize('eliminar-clientes');

        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado com sucesso!');
    }
}
