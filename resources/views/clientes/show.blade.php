<x-app-layout>
    <x-slot name="header">
        <div>
            <x-breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Clientes', 'url' => route('clientes.index')],
                ['label' => $cliente->nome],
            ]" />
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="dashboard-kicker">Perfil do cliente</span>
                <h2 class="fs-4 fw-bold mb-0">{{ $cliente->nome }}</h2>
                <p class="text-muted mb-0">Informação detalhada, histórico de compras e dados comerciais.</p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                    Voltar
                </a>

                @can('editar-clientes')
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary">
                        Editar Cliente
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="dashboard-card h-100">
                    <div class="text-center">
                        <div class="client-avatar mx-auto mb-3">
                            {{ strtoupper(substr($cliente->nome, 0, 1)) }}
                        </div>

                        <h3 class="h4 fw-bold mb-1">{{ $cliente->nome }}</h3>
                        <p class="text-muted mb-3">{{ $cliente->email }}</p>

                        <span class="badge bg-primary-subtle text-primary px-3 py-2">
                            Cliente #{{ $cliente->id }}
                        </span>
                    </div>

                    <hr class="my-4">

                    <div class="client-contact-list">
                        <div class="client-contact-item">
                            <span>Email</span>
                            <strong>{{ $cliente->email }}</strong>
                        </div>

                        <div class="client-contact-item">
                            <span>Telefone</span>
                            <strong>{{ $cliente->telefone }}</strong>
                        </div>

                        <div class="client-contact-item">
                            <span>NIF</span>
                            <strong>{{ $cliente->nif }}</strong>
                        </div>

                        <div class="client-contact-item">
                            <span>Morada</span>
                            <strong>{{ $cliente->morada }}</strong>
                        </div>
                    </div>

                    @can('eliminar-clientes')
                        <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-outline-danger w-100"
                                onclick="return confirm('Tens a certeza que queres eliminar este cliente?')">
                                Eliminar Cliente
                            </button>
                        </form>
                    @endcan
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="dashboard-card dashboard-stat-card h-100">
                            <span class="dashboard-label">Compras</span>
                            <h3>{{ $totalCompras }}</h3>
                            <small class="dashboard-meta">Viaturas compradas</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-card dashboard-stat-card h-100">
                            <span class="dashboard-label">Total Gasto</span>
                            <h3>{{ number_format($totalGasto, 2, ',', '.') }} €</h3>
                            <small class="dashboard-meta">Valor acumulado</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-card dashboard-stat-card h-100">
                            <span class="dashboard-label">Última Compra</span>
                            <h3>
                                @if ($ultimaCompra)
                                    {{ \Carbon\Carbon::parse($ultimaCompra->data_venda)->format('d/m/Y') }}
                                @else
                                    —
                                @endif
                            </h3>
                            <small class="dashboard-meta">Data mais recente</small>
                        </div>
                    </div>
                </div>

                <div class="dashboard-panel">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Histórico de Compras</h4>
                            <p class="dashboard-panel-subtitle">Vendas associadas a este cliente</p>
                        </div>

                        @can('gerir-vendas')
                            <a href="{{ route('vendas.create') }}" class="btn btn-sm btn-primary">
                                Nova Venda
                            </a>
                        @endcan
                    </div>

                    @if ($cliente->vendas->count())
                        <div class="table-responsive">
                            <table class="table dashboard-table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Viatura</th>
                                        <th>Data</th>
                                        <th>Valor</th>
                                        <th>Observações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($cliente->vendas->sortByDesc('data_venda') as $venda)
                                        <tr>
                                            <td>
                                                <strong>
                                                    {{ $venda->viatura->marca ?? '—' }}
                                                    {{ $venda->viatura->modelo ?? '' }}
                                                </strong>
                                            </td>

                                            <td>
                                                {{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}
                                            </td>

                                            <td>
                                                {{ number_format($venda->preco_venda, 2, ',', '.') }} €
                                            </td>

                                            <td class="text-muted">
                                                {{ $venda->observacoes ?: '—' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="dashboard-empty-state">
                            Este cliente ainda não tem compras registadas.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
