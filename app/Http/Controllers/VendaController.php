<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Viatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Support\ActivityLogger;

class VendaController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('ver-vendas');

        $search = $request->input('search');

        $totalVendas = Venda::count();

        $faturacaoTotal = Venda::sum('preco_venda');

        $vendaMedia = Venda::avg('preco_venda');

        $melhorVenda = Venda::max('preco_venda');

        $vendas = Venda::with(['cliente', 'viatura'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->whereHas('cliente', function ($clienteQuery) use ($search) {
                        $clienteQuery->where('nome', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%")
                            ->orWhere('telefone', 'like', "%{$search}%")
                            ->orWhere('nif', 'like', "%{$search}%");
                    })->orWhereHas('viatura', function ($viaturaQuery) use ($search) {
                        $viaturaQuery->where('marca', 'like', "%{$search}%")
                            ->orWhere('modelo', 'like', "%{$search}%")
                            ->orWhere('matricula', 'like', "%{$search}%");
                    })->orWhere('preco_venda', 'like', "%{$search}%")
                        ->orWhere('data_venda', 'like', "%{$search}%");
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('vendas.index', compact(
            'vendas',
            'search',
            'totalVendas',
            'faturacaoTotal',
            'vendaMedia',
            'melhorVenda'
        ));
    }

    public function create()
    {
        Gate::authorize('criar-vendas');

        $clientes = Cliente::orderBy('nome')->get();
        $viaturas = Viatura::where('vendido', false)->orderBy('marca')->get();

        return view('vendas.create', compact('clientes', 'viaturas'));
    }

    public function store(Request $request)
    {
        Gate::authorize('criar-vendas');

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'viatura_id' => 'required|exists:viaturas,id',
            'data_venda' => 'required|date',
            'preco_venda' => 'required|numeric|min:0',
        ]);

        $viatura = Viatura::findOrFail($request->viatura_id);

        if ($viatura->vendido) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['viatura_id' => 'Esta viatura já foi vendida.']);
        }

        $venda = Venda::create([
            'cliente_id' => $request->cliente_id,
            'viatura_id' => $request->viatura_id,
            'data_venda' => $request->data_venda,
            'preco_venda' => $request->preco_venda,
        ]);

        ActivityLogger::log(
            'criou',
            'Venda',
            $venda->id,
            'Registou a venda #' . $venda->id
        );

        $viatura->update([
            'vendido' => true,
        ]);

        return redirect()->route('vendas.index')->with('success', 'Venda registada com sucesso!');
    }

    public function show(Venda $venda)
    {
        Gate::authorize('ver-vendas');

        return view('vendas.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        Gate::authorize('editar-vendas');

        $clientes = Cliente::orderBy('nome')->get();

        $viaturas = Viatura::where('vendido', false)
            ->orWhere('id', $venda->viatura_id)
            ->orderBy('marca')
            ->get();

        return view('vendas.edit', compact('venda', 'clientes', 'viaturas'));
    }

    public function update(Request $request, Venda $venda)
    {
        Gate::authorize('editar-vendas');

        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'viatura_id' => 'required|exists:viaturas,id',
            'data_venda' => 'required|date',
            'preco_venda' => 'required|numeric|min:0',
            'observacoes' => 'nullable|string',
        ]);

        $viaturaAntiga = Viatura::findOrFail($venda->viatura_id);
        $novaViatura = Viatura::findOrFail($request->viatura_id);

        if ($novaViatura->id != $viaturaAntiga->id && $novaViatura->vendido) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['viatura_id' => 'Esta viatura já foi vendida.']);
        }

        if ($viaturaAntiga->id != $novaViatura->id) {
            $viaturaAntiga->update(['vendido' => false]);
            $novaViatura->update(['vendido' => true]);
        }

        $venda->update([
            'cliente_id' => $request->cliente_id,
            'viatura_id' => $request->viatura_id,
            'data_venda' => $request->data_venda,
            'preco_venda' => $request->preco_venda,
            'observacoes' => $request->observacoes,
        ]);
        ActivityLogger::log(
            'editou',
            'Venda',
            $venda->id,
            'Editou a venda #' . $venda->id
        );

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(Venda $venda)
    {
        Gate::authorize('eliminar-vendas');

        $viatura = Viatura::findOrFail($venda->viatura_id);

        $vendaId = $venda->id;

        $venda->delete();

        ActivityLogger::log(
            'eliminou',
            'Venda',
            $vendaId,
            'Eliminou a venda #' . $vendaId
        );

        $viatura->update([
            'vendido' => false,
        ]);

        return redirect()->route('vendas.index')->with('success', 'Venda eliminada com sucesso!');
    }
}
