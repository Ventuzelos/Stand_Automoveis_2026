<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Models\Cliente;
use App\Models\Viatura;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with(['cliente', 'viatura'])->orderBy('id', 'desc')->paginate(10);
        return view('vendas.index', compact('vendas'));
    }

    public function create()
    {
        $clientes = Cliente::orderBy('nome')->get();
        $viaturas = Viatura::where('vendido', false)->orderBy('marca')->get();

        return view('vendas.create', compact('clientes', 'viaturas'));
    }

    public function store(Request $request)
    {
        //
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

        Venda::create([
            'cliente_id' => $request->cliente_id,
            'viatura_id' => $request->viatura_id,
            'data_venda' => $request->data_venda,
            'preco_venda' => $request->preco_venda,
        ]);

        $viatura->update([
            'vendido' => true,
        ]);

        return redirect()->route('vendas.index')->with('success', 'Venda registada com sucesso!');
    }

    public function show(Venda $venda)
    {
        //
    }

    public function edit(Venda $venda)
    {
        //
        $clientes = Cliente::orderBy('nome')->get();

        $viaturas = Viatura::where('vendido', false)
            ->orWhere('id', $venda->viatura_id)
            ->orderBy('marca')
            ->get();

        return view('vendas.edit', compact('venda', 'clientes', 'viaturas'));
    }

    public function update(Request $request, Venda $venda)
    {
        //
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'viatura_id' => 'required|exists:viaturas,id',
            'data_venda' => 'required|date',
            'preco_venda' => 'required|numeric|min:0',
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
        ]);

        return redirect()->route('vendas.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy(Venda $venda)
    {
        //
        $viatura = Viatura::findOrFail($venda->viatura_id);

        $venda->delete();

        $viatura->update([
            'vendido' => false,
        ]);

        return redirect()->route('vendas.index')->with('success', 'Venda eliminada com sucesso!');
    }
}
