<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Viatura;
use App\Models\Venda;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $inicioMes = Carbon::now()->startOfMonth();
        $vendasMes = Venda::whereDate('data_venda', '>=', $inicioMes)
            ->count();

        $faturacaoMes = Venda::whereDate('data_venda', '>=', $inicioMes)
            ->sum('preco_venda');

        $clientesMes = Cliente::whereDate('created_at', '>=', $inicioMes)
            ->count();

        $viaturasMes = Viatura::whereDate('created_at', '>=', $inicioMes)
            ->count();
        $totalClientes = Cliente::count();
        $totalViaturas = Viatura::count();
        $totalVendas = Venda::count();
        $viaturasDisponiveis = Viatura::where('vendido', false)->count();
        $viaturasVendidas = Viatura::where('vendido', true)->count();
        $valorTotalVendas = Venda::sum('preco_venda');
        $precoMedioViaturas = Viatura::avg('preco');
        $valorMedioVendas = Venda::avg('preco_venda');
        $taxaVenda = $totalViaturas > 0
            ? round(($viaturasVendidas / $totalViaturas) * 100)
            : 0;
        $melhorVenda = Venda::max('preco_venda');
        $topViaturas = Venda::select(
            'viatura_id',
            DB::raw('COUNT(*) as total_vendas')
        )
            ->with('viatura')
            ->groupBy('viatura_id')
            ->orderByDesc('total_vendas')
            ->take(5)
            ->get();

        $ultimasVendas = Venda::with(['cliente', 'viatura'])
            ->latest()
            ->take(5)
            ->get();

        $ultimasViaturas = Viatura::latest()
            ->take(5)
            ->get();

        $vendasMensais = Venda::selectRaw("
        MONTH(data_venda) as mes,
        SUM(preco_venda) as total
    ")
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $nomesMeses = [
            1 => 'Jan',
            2 => 'Fev',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'Mai',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Set',
            10 => 'Out',
            11 => 'Nov',
            12 => 'Dez',
        ];

        $chartLabels = $vendasMensais->map(function ($item) use ($nomesMeses) {
            return $nomesMeses[$item->mes];
        });

        $chartValues = $vendasMensais->map(function ($item) {
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
            'chartValues',
            'taxaVenda',
            'melhorVenda',
            'vendasMes',
            'faturacaoMes',
            'clientesMes',
            'viaturasMes',
            'topViaturas',
        ));
    }
}
