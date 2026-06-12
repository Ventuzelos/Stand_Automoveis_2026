<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Viatura;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalViaturas = Viatura::count();
        $totalVendas = Venda::count();
        $viaturasDisponiveis = Viatura::where('vendido', false)->count();
        $viaturasVendidas = Viatura::where('vendido', true)->count();
        $valorTotalVendas = Venda::sum('preco_venda');
        $precoMedioViaturas = Viatura::avg('preco');
        $valorMedioVendas = Venda::avg('preco_venda');

        $ultimasVendas = Venda::with(['cliente', 'viatura'])
            ->latest()
            ->take(5)
            ->get();

        $ultimasViaturas = Viatura::latest()
            ->take(5)
            ->get();

        $vendasRecentes = Venda::select('data_venda', DB::raw('SUM(preco_venda) as total'))
            ->groupBy('data_venda')
            ->orderBy('data_venda', 'asc')
            ->take(7)
            ->get();

        $chartLabels = $vendasRecentes->map(function ($item) {
            return \Carbon\Carbon::parse($item->data_venda)->format('d/m');
        });

        $chartValues = $vendasRecentes->map(function ($item) {
            return (float) $item->total;
        });

        return view('dashboard', compact(
            'totalClientes',
            'totalViaturas',
            'totalVendas',
            'viaturasDisponiveis',
            'viaturasVendidas',
            'valorTotalVendas',
            'precoMedioViaturas',
            'valorMedioVendas',
            'ultimasVendas',
            'ultimasViaturas',
            'chartLabels',
            'chartValues'
        ));
    }
}
