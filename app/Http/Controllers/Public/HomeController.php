<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
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

        $totalMarcas = Viatura::where('vendido', 0)
            ->distinct()
            ->count('marca');

        return view('public.home', compact(
            'viaturasRecentes',
            'totalDisponiveis',
            'totalMarcas'
        ));
    }
}
