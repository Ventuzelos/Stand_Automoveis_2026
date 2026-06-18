<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="dashboard-kicker">Gestão comercial</span>
                <h2 class="fs-4 fw-bold mb-0">Lista de Vendas</h2>
                <p class="text-muted mb-0">Consulta, pesquisa e acompanhamento das operações comerciais.</p>
            </div>
            <div>
                @can('criar-vendas')
                    <a href="{{ route('vendas.create') }}" class="btn btn-primary">
                        Nova Venda
                    </a>
                @endcan
                <a href="{{ route('export.vendas') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-download me-1"></i>
                    Exportar CSV
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Total Vendas</span>
                            <h3>{{ $totalVendas }}</h3>
                            <small class="dashboard-meta">Operações registadas</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-receipt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Faturação Total</span>
                            <h3>{{ number_format($faturacaoTotal, 2, ',', '.') }} €</h3>
                            <small class="dashboard-meta">Valor acumulado</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Venda Média</span>
                            <h3>{{ number_format($vendaMedia ?? 0, 2, ',', '.') }} €</h3>
                            <small class="dashboard-meta">Ticket médio comercial</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Melhor Venda</span>
                            <h3>{{ number_format($melhorVenda ?? 0, 2, ',', '.') }} €</h3>
                            <small class="dashboard-meta">Maior valor registado</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-trophy"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h4 class="dashboard-panel-title">Registos de vendas</h4>
                    <p class="dashboard-panel-subtitle">
                        Pesquisa por cliente, email, NIF, viatura, matrícula, valor ou data.
                    </p>
                </div>
            </div>

            <form action="{{ route('vendas.index') }}" method="GET" class="mb-4">
                <div class="search-unified">
                    <div class="search-unified-group search-unified-input-group">
                        <input type="text" name="search" class="search-unified-input"
                            placeholder="Pesquisar por cliente, viatura, matrícula, valor ou data"
                            value="{{ request('search') }}">

                        @if (request('search'))
                            <a href="{{ route('vendas.index') }}" class="search-unified-clear" aria-label="Limpar">
                                &times;
                            </a>
                        @endif
                    </div>

                    <div class="search-unified-separator"></div>

                    <button type="submit" class="search-unified-submit" aria-label="Pesquisar">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            @if ($vendas->count() > 0)
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-hover align-middle sales-table mb-0">
                        <thead>
                            <tr>
                                <th>Venda</th>
                                <th>Cliente</th>
                                <th>Viatura</th>
                                <th>Data</th>
                                <th>Valor</th>
                                <th>Observações</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($vendas as $venda)
                                <tr>
                                    <td>
                                        <strong>#{{ $venda->id }}</strong>
                                        <div class="text-muted small">Registo comercial</div>
                                    </td>

                                    <td>
                                        <strong class="d-block">{{ $venda->cliente->nome ?? 'Sem cliente' }}</strong>
                                        <small class="text-muted">{{ $venda->cliente->email ?? '—' }}</small>
                                    </td>

                                    <td>
                                        <strong class="d-block">
                                            {{ $venda->viatura->marca ?? '' }}
                                            {{ $venda->viatura->modelo ?? '' }}
                                        </strong>
                                        <small class="text-muted">
                                            {{ $venda->viatura->matricula ?? '—' }}
                                        </small>
                                    </td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}
                                    </td>

                                    <td>
                                        <strong>{{ number_format($venda->preco_venda, 2, ',', '.') }} €</strong>
                                    </td>

                                    <td>
                                        <div class="table-text-limit" title="{{ $venda->observacoes }}">
                                            {{ $venda->observacoes ?: '—' }}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="table-actions">
                                            <a href="{{ route('vendas.show', $venda->id) }}"
                                                class="btn btn-action-view btn-sm">
                                                Ver
                                            </a>

                                            @can('editar-vendas')
                                                <a href="{{ route('vendas.edit', $venda->id) }}"
                                                    class="btn btn-action-edit btn-sm">
                                                    Editar
                                                </a>
                                            @endcan

                                            @can('eliminar-vendas')
                                                <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST"
                                                    class="d-inline m-0">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-action-delete btn-sm"
                                                        onclick="return confirm('Tens a certeza que queres eliminar esta venda?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="sales-mobile-list d-lg-none">
                    @foreach ($vendas as $venda)
                        <div class="sale-mobile-card">
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                <div>
                                    <h3 class="h6 fw-bold mb-1">
                                        Venda #{{ $venda->id }}
                                    </h3>
                                    <p class="text-muted small mb-0">
                                        {{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}
                                    </p>
                                </div>

                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    Concluída
                                </span>
                            </div>

                            <div class="sale-mobile-info">
                                <div>
                                    <span>Cliente</span>
                                    <strong>{{ $venda->cliente->nome ?? 'Sem cliente' }}</strong>
                                </div>

                                <div>
                                    <span>Viatura</span>
                                    <strong>
                                        {{ $venda->viatura->marca ?? '' }}
                                        {{ $venda->viatura->modelo ?? '' }}
                                    </strong>
                                </div>

                                <div>
                                    <span>Matrícula</span>
                                    <strong>{{ $venda->viatura->matricula ?? '—' }}</strong>
                                </div>

                                <div>
                                    <span>Valor</span>
                                    <strong>{{ number_format($venda->preco_venda, 2, ',', '.') }} €</strong>
                                </div>
                            </div>

                            @if ($venda->observacoes)
                                <div class="mt-3 text-muted small">
                                    {{ $venda->observacoes }}
                                </div>
                            @endif

                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('vendas.show', $venda->id) }}"
                                    class="btn btn-action-view btn-sm flex-fill">
                                    Ver
                                </a>

                                @can('editar-vendas')
                                    <a href="{{ route('vendas.edit', $venda->id) }}"
                                        class="btn btn-action-edit btn-sm flex-fill">
                                        Editar
                                    </a>
                                @endcan
                            </div>

                            @can('eliminar-vendas')
                                <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-action-delete btn-sm w-100"
                                        onclick="return confirm('Tens a certeza que queres eliminar esta venda?')">
                                        Eliminar
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $vendas->links() }}
                </div>
            @else
                <div class="dashboard-empty-state">
                    Não foram encontradas vendas.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
