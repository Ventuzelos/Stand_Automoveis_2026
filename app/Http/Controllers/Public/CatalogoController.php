<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Viatura;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        $marca = $request->input('marca');
        $modelo = $request->input('modelo');
        $ano = $request->input('ano');
        $precoMin = $request->input('preco_min');
        $precoMax = $request->input('preco_max');
        $pesquisa = $request->input('pesquisa');
        $ordenar = $request->input('ordenar', 'recentes');

        $query = Viatura::query()->where('vendido', 0);

        if ($marca) {
            $query->where('marca', $marca);
        }

        if ($modelo) {
            $query->where('modelo', 'like', '%' . $modelo . '%');
        }

        if ($ano) {
            $query->where('ano', $ano);
        }

        if ($precoMin !== null && $precoMin !== '') {
            $query->where('preco', '>=', $precoMin);
        }

        if ($precoMax !== null && $precoMax !== '') {
            $query->where('preco', '<=', $precoMax);
        }

        if ($pesquisa) {
            $query->where(function ($q) use ($pesquisa) {
                $q->where('marca', 'like', '%' . $pesquisa . '%')
                    ->orWhere('modelo', 'like', '%' . $pesquisa . '%')
                    ->orWhere('cor', 'like', '%' . $pesquisa . '%')
                    ->orWhere('combustivel', 'like', '%' . $pesquisa . '%');
            });
        }

        switch ($ordenar) {
            case 'preco_asc':
                $query->orderBy('preco', 'asc');
                break;
            case 'preco_desc':
                $query->orderBy('preco', 'desc');
                break;
            case 'ano_desc':
                $query->orderBy('ano', 'desc');
                break;
            case 'ano_asc':
                $query->orderBy('ano', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $viaturas = $query->paginate(9)->withQueryString();

        $marcas = Viatura::where('vendido', 0)
            ->select('marca')
            ->distinct()
            ->orderBy('marca')
            ->pluck('marca');

        $anos = Viatura::where('vendido', 0)
            ->select('ano')
            ->distinct()
            ->orderByDesc('ano')
            ->pluck('ano');

        return view('public.catalogo', compact(
            'viaturas',
            'marcas',
            'anos',
            'marca',
            'modelo',
            'ano',
            'precoMin',
            'precoMax',
            'pesquisa',
            'ordenar'
        ));
    }

    public function show(Viatura $viatura)
    {
        if ($viatura->vendido) {
            abort(404);
        }

        return view('public.viatura-show', compact('viatura'));
    }
}
