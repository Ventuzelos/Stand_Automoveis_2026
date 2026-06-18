<?php

namespace App\Http\Controllers;

use App\Models\Viatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Support\ActivityLogger;

class ViaturaController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('ver-viaturas');

        $search = $request->input('search');
        $sort = $request->input('sort', 'id');
        $direction = $request->input('direction', 'desc');

        $allowedSorts = ['id', 'marca', 'modelo', 'ano', 'preco'];
        $allowedDirections = ['asc', 'desc'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'id';
        }

        if (!in_array($direction, $allowedDirections)) {
            $direction = 'desc';
        }

        $totalViaturas = Viatura::count();

        $viaturasDisponiveis = Viatura::where('vendido', false)->count();

        $viaturasVendidas = Viatura::where('vendido', true)->count();

        $valorStock = Viatura::where('vendido', false)->sum('preco');

        $precoMedio = Viatura::avg('preco');

        $viaturas = Viatura::query()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('marca', 'like', "%{$search}%")
                        ->orWhere('modelo', 'like', "%{$search}%")
                        ->orWhere('matricula', 'like', "%{$search}%")
                        ->orWhere('ano', 'like', "%{$search}%")
                        ->orWhere('cor', 'like', "%{$search}%")
                        ->orWhere('combustivel', 'like', "%{$search}%");
                });
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('viaturas.index', compact(
            'viaturas',
            'search',
            'sort',
            'direction',
            'totalViaturas',
            'viaturasDisponiveis',
            'viaturasVendidas',
            'valorStock',
            'precoMedio'
        ));
    }

    public function create()
    {
        Gate::authorize('criar-viaturas');

        return view('viaturas.create');
    }

    public function store(Request $request)
    {
        Gate::authorize('criar-viaturas');

        $request->validate([
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'matricula' => 'required|string|max:20|unique:viaturas,matricula',
            'ano' => 'required|integer|min:1900|max:' . date('Y'),
            'cor' => 'required|string|max:50',
            'preco' => 'required|numeric|min:0',
            'combustivel' => 'required|string|max:50',
            'quilometragem' => 'required|integer|min:0',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'vendido' => 'required|in:0,1',
        ]);

        $dados = [
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'matricula' => $request->matricula,
            'ano' => $request->ano,
            'cor' => $request->cor,
            'preco' => $request->preco,
            'combustivel' => $request->combustivel,
            'quilometragem' => $request->quilometragem,
            'vendido' => $request->vendido,
        ];

        if ($request->hasFile('imagem')) {
            $dados['imagem'] = $request->file('imagem')->store('viaturas', 'public');
        }

        $viatura = Viatura::create($dados);

        ActivityLogger::log(
            'criou',
            'Viatura',
            $viatura->id,
            'Criou a viatura ' . $viatura->marca . ' ' . $viatura->modelo
        );

        return redirect()->route('viaturas.index')->with('success', 'Viatura criada com sucesso!');
    }

    public function show(Viatura $viatura)
    {
        Gate::authorize('ver-viaturas');

        $viatura->load(['venda.cliente']);

        return view('viaturas.show', compact('viatura'));
    }

    public function edit(Viatura $viatura)
    {
        Gate::authorize('editar-viaturas');

        return view('viaturas.edit', compact('viatura'));
    }

    public function update(Request $request, Viatura $viatura)
    {
        Gate::authorize('editar-viaturas');

        $request->validate([
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'matricula' => 'required|string|max:20|unique:viaturas,matricula,' . $viatura->id,
            'ano' => 'required|integer|min:1900|max:' . date('Y'),
            'cor' => 'required|string|max:50',
            'preco' => 'required|numeric|min:0',
            'combustivel' => 'required|string|max:50',
            'quilometragem' => 'required|integer|min:0',
            'imagem' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'vendido' => 'required|in:0,1',
        ]);

        $dados = [
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'matricula' => $request->matricula,
            'ano' => $request->ano,
            'cor' => $request->cor,
            'preco' => $request->preco,
            'combustivel' => $request->combustivel,
            'quilometragem' => $request->quilometragem,
            'vendido' => $request->vendido,
        ];

        if ($request->hasFile('imagem')) {
            if ($viatura->imagem) {
                Storage::disk('public')->delete($viatura->imagem);
            }

            $dados['imagem'] = $request->file('imagem')->store('viaturas', 'public');
        }

        $viatura->update($dados);
        ActivityLogger::log(
            'editou',
            'Viatura',
            $viatura->id,
            'Editou a viatura ' . $viatura->marca . ' ' . $viatura->modelo
        );

        return redirect()->route('viaturas.index')->with('success', 'Viatura atualizada com sucesso!');
    }

    public function destroy(Viatura $viatura)
    {
        Gate::authorize('eliminar-viaturas');

        if ($viatura->imagem) {
            Storage::disk('public')->delete($viatura->imagem);
        }

        $descricaoViatura = $viatura->marca . ' ' . $viatura->modelo;
        $viaturaId = $viatura->id;
        $viatura->delete();
        ActivityLogger::log(
            'eliminou',
            'Viatura',
            $viaturaId,
            'Eliminou a viatura ' . $descricaoViatura
        );

        return redirect()->route('viaturas.index')->with('success', 'Viatura eliminada com sucesso!');
    }
}
