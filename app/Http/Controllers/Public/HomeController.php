<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Venda;
use App\Models\Viatura;

class HomeController extends Controller
{
    public function index()
    {
        $viaturasRecentes = Viatura::where('vendido', 0)
            ->latest()
            ->take(6)
            ->get();

        $totalDisponiveis = Viatura::where('vendido', 0)->count();

        $totalVendidas = Viatura::where('vendido', 1)->count();

        $totalClientes = Cliente::count();

        $totalVendas = Venda::count();

        $totalMarcas = Viatura::where('vendido', 0)
            ->distinct()
            ->count('marca');

        $marcasDisponiveis = Viatura::where('vendido', 0)
            ->select('marca')
            ->distinct()
            ->orderBy('marca')
            ->pluck('marca');

        return view('public.home', compact(
            'viaturasRecentes',
            'totalDisponiveis',
            'totalVendidas',
            'totalClientes',
            'totalVendas',
            'totalMarcas',
            'marcasDisponiveis'
        ));
    }
}
