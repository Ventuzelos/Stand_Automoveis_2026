<?php

namespace App\Http\Controllers;

use App\Models\Viatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViaturaController extends Controller
{
    public function index()
    {
        $viaturas = Viatura::all();
        return view('viaturas.index', compact('viaturas'));
    }

    public function create()
    {
        return view('viaturas.create');
    }

    public function store(Request $request)
    {
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
        ]);

        $caminhoImagem = null;

        if ($request->hasFile('imagem')) {
            $caminhoImagem = $request->file('imagem')->store('viaturas', 'public');
        }

        Viatura::create([
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'matricula' => $request->matricula,
            'ano' => $request->ano,
            'cor' => $request->cor,
            'preco' => $request->preco,
            'combustivel' => $request->combustivel,
            'quilometragem' => $request->quilometragem,
            'imagem' => $caminhoImagem,
            'vendido' => $request->has('vendido'),
        ]);

        return redirect()->route('viaturas.index')->with('success', 'Viatura criada com sucesso!');
    }

    public function show(Viatura $viatura)
    {
        //
    }

    public function edit(Viatura $viatura)
    {
        return view('viaturas.edit', compact('viatura'));
    }

    public function update(Request $request, Viatura $viatura)
    {
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
            'vendido' => $request->has('vendido'),
        ];

        if ($request->hasFile('imagem')) {
            if ($viatura->imagem) {
                Storage::disk('public')->delete($viatura->imagem);
            }

            $dados['imagem'] = $request->file('imagem')->store('viaturas', 'public');
        }

        $viatura->update($dados);

        return redirect()->route('viaturas.index')->with('success', 'Viatura atualizada com sucesso!');
    }

    public function destroy(Viatura $viatura)
    {
        if ($viatura->imagem) {
            Storage::disk('public')->delete($viatura->imagem);
        }

        $viatura->delete();

        return redirect()->route('viaturas.index')->with('success', 'Viatura eliminada com sucesso!');
    }
}
