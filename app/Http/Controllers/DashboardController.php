<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Viatura;
use App\Models\Venda;

class DashboardController extends Controller
{
    public function index()
    {
        $totalClientes = Cliente::count();
        $totalViaturas = Viatura::count();
        $viaturasDisponiveis = Viatura::where('vendido', false)->count();
        $viaturasVendidas = Viatura::where('vendido', true)->count();
        $totalVendas = Venda::count();
        $valorTotalVendas = Venda::sum('preco_venda');

        return view('dashboard', compact(
            'totalClientes',
            'totalViaturas',
            'viaturasDisponiveis',
            'viaturasVendidas',
            'totalVendas',
            'valorTotalVendas'
        ));
    }
}
