<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Venda;
use App\Models\Viatura;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function clientes(): StreamedResponse
    {
        Gate::authorize('ver-clientes');

        $filename = 'clientes_' . now()->format('Y-m-d_H-i') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, ['ID', 'Nome', 'Email', 'Telefone', 'NIF', 'Morada'], ';');

            Cliente::orderBy('id')->chunk(100, function ($clientes) use ($handle) {
                foreach ($clientes as $cliente) {
                    fputcsv($handle, [
                        $cliente->id,
                        $cliente->nome,
                        $cliente->email,
                        $cliente->telefone,
                        $cliente->nif,
                        $cliente->morada,
                    ], ';');
                }
            });

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function viaturas(): StreamedResponse
    {
        Gate::authorize('ver-viaturas');

        $filename = 'viaturas_' . now()->format('Y-m-d_H-i') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'ID',
                'Marca',
                'Modelo',
                'Matrícula',
                'Ano',
                'Cor',
                'Combustível',
                'Quilometragem',
                'Preço',
                'Estado',
            ], ';');

            Viatura::orderBy('id')->chunk(100, function ($viaturas) use ($handle) {
                foreach ($viaturas as $viatura) {
                    fputcsv($handle, [
                        $viatura->id,
                        $viatura->marca,
                        $viatura->modelo,
                        $viatura->matricula,
                        $viatura->ano,
                        $viatura->cor,
                        $viatura->combustivel,
                        $viatura->quilometragem,
                        number_format($viatura->preco, 2, ',', '.'),
                        $viatura->vendido ? 'Vendida' : 'Disponível',
                    ], ';');
                }
            });

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    public function vendas(): StreamedResponse
    {
        Gate::authorize('ver-vendas');

        $filename = 'vendas_' . now()->format('Y-m-d_H-i') . '.csv';

        return response()->streamDownload(function () {
            $handle = fopen('php://output', 'w');
            fprintf($handle, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($handle, [
                'ID',
                'Cliente',
                'Email Cliente',
                'Viatura',
                'Matrícula',
                'Data Venda',
                'Valor Venda',
                'Observações',
            ], ';');

            Venda::with(['cliente', 'viatura'])
                ->orderBy('id')
                ->chunk(100, function ($vendas) use ($handle) {
                    foreach ($vendas as $venda) {
                        fputcsv($handle, [
                            $venda->id,
                            $venda->cliente->nome ?? '',
                            $venda->cliente->email ?? '',
                            trim(($venda->viatura->marca ?? '') . ' ' . ($venda->viatura->modelo ?? '')),
                            $venda->viatura->matricula ?? '',
                            $venda->data_venda,
                            number_format($venda->preco_venda, 2, ',', '.'),
                            $venda->observacoes ?? '',
                        ], ';');
                    }
                });

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }
}
