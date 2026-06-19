<x-app-layout>
    <x-slot name="header">
        <div>
            <x-breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('dashboard')], ['label' => 'Viaturas']]" />
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="dashboard-kicker">Gestão de viaturas</span>
                <h2 class="fs-4 fw-bold mb-0">Lista de Viaturas</h2>
                <p class="text-muted mb-0">Consulta, pesquisa e gestão do stock automóvel.</p>
            </div>
            <div>
                @can('criar-viaturas')
                    <a href="{{ route('viaturas.create') }}" class="btn btn-primary">
                        Nova Viatura
                    </a>
                @endcan
                <a href="{{ route('export.viaturas') }}" class="btn btn-outline-secondary">
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
            <div class="col-md-6 col-xl">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Total Viaturas</span>
                            <h3>{{ $totalViaturas }}</h3>
                            <small class="dashboard-meta">Stock global</small>
                        </div>
                        <div class="dashboard-stat-icon">
                            <i class="bi bi-car-front"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Disponíveis</span>
                            <h3>{{ $viaturasDisponiveis }}</h3>
                            <small class="dashboard-meta">Atualmente em stock</small>
                        </div>
                        <div class="dashboard-stat-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Vendidas</span>
                            <h3>{{ $viaturasVendidas }}</h3>
                            <small class="dashboard-meta">Associadas a vendas</small>
                        </div>
                        <div class="dashboard-stat-icon">
                            <i class="bi bi-tag"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Valor Stock</span>
                            <h3>{{ number_format($valorStock, 2, ',', '.') }} €</h3>
                            <small class="dashboard-meta">Viaturas disponíveis</small>
                        </div>
                        <div class="dashboard-stat-icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Preço Médio</span>
                            <h3>{{ number_format($precoMedio ?? 0, 2, ',', '.') }} €</h3>
                            <small class="dashboard-meta">Média do catálogo</small>
                        </div>
                        <div class="dashboard-stat-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h4 class="dashboard-panel-title">Stock de viaturas</h4>
                    <p class="dashboard-panel-subtitle">
                        Pesquisa por marca, modelo, matrícula, ano, cor ou combustível.
                    </p>
                </div>
            </div>

            <form action="{{ route('viaturas.index') }}" method="GET" class="mb-4">
                <div class="search-unified">
                    <div class="search-unified-group search-unified-input-group">
                        <input type="text" name="search" class="search-unified-input"
                            placeholder="Pesquisar por marca, modelo, matrícula, ano, cor ou combustível"
                            value="{{ request('search') }}">

                        @if (request('search') || request('sort') || request('direction'))
                            <a href="{{ route('viaturas.index') }}" class="search-unified-clear" aria-label="Limpar">
                                &times;
                            </a>
                        @endif
                    </div>

                    <div class="search-unified-separator"></div>

                    <div class="search-unified-group">
                        <select name="sort" class="search-unified-select">
                            <option value="id" {{ request('sort', 'id') == 'id' ? 'selected' : '' }}>ID</option>
                            <option value="marca" {{ request('sort') == 'marca' ? 'selected' : '' }}>Marca</option>
                            <option value="modelo" {{ request('sort') == 'modelo' ? 'selected' : '' }}>Modelo</option>
                            <option value="ano" {{ request('sort') == 'ano' ? 'selected' : '' }}>Ano</option>
                            <option value="preco" {{ request('sort') == 'preco' ? 'selected' : '' }}>Preço</option>
                        </select>
                    </div>

                    <div class="search-unified-separator"></div>

                    <div class="search-unified-group">
                        <select name="direction" class="search-unified-select">
                            <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascendente
                            </option>
                            <option value="desc" {{ request('direction', 'desc') == 'desc' ? 'selected' : '' }}>
                                Descendente</option>
                        </select>
                    </div>

                    <div class="search-unified-separator"></div>

                    <button type="submit" class="search-unified-submit" aria-label="Pesquisar">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

            @if ($viaturas->count() > 0)
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-hover align-middle vehicles-table mb-0">
                        <thead>
                            <tr>
                                <th>Viatura</th>
                                <th>Ano</th>
                                <th>Combustível</th>
                                <th>Km</th>
                                <th>Preço</th>
                                <th>Estado</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($viaturas as $viatura)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="vehicle-table-image">
                                                @if ($viatura->imagem_url)
                                                    <img src="{{ $viatura->imagem_url }}"
                                                        alt="{{ $viatura->marca }} {{ $viatura->modelo }}">
                                                @else
                                                    <span>Sem imagem</span>
                                                @endif
                                            </div>

                                            <div>
                                                <strong class="d-block">
                                                    {{ $viatura->marca }} {{ $viatura->modelo }}
                                                </strong>
                                                <small class="text-muted">
                                                    {{ $viatura->matricula }} · {{ $viatura->cor }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $viatura->ano }}</td>
                                    <td>{{ $viatura->combustivel }}</td>
                                    <td>{{ number_format($viatura->quilometragem, 0, ',', '.') }} km</td>
                                    <td>
                                        <strong>{{ number_format($viatura->preco, 2, ',', '.') }} €</strong>
                                    </td>

                                    <td>
                                        @if ($viatura->vendido)
                                            <span
                                                class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                                Vendida
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle">
                                                Disponível
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="table-actions">
                                            <a href="{{ route('viaturas.show', $viatura->id) }}"
                                                data-bs-toggle="tooltip" title="Ver detalhes"
                                                class="btn btn-action-view btn-sm">
                                                Ver
                                            </a>

                                            @can('editar-viaturas')
                                                <a href="{{ route('viaturas.edit', $viatura->id) }}"
                                                    data-bs-toggle="tooltip" title="Editar registo"
                                                    class="btn btn-action-edit btn-sm">
                                                    Editar
                                                </a>
                                            @endcan

                                            @can('eliminar-viaturas')
                                                <form action="{{ route('viaturas.destroy', $viatura->id) }}"
                                                    method="POST" class="d-inline m-0">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-action-delete btn-sm"
                                                        data-bs-toggle="tooltip" title="Eliminar registo"
                                                        onclick="return confirm('Tens a certeza que queres eliminar esta viatura?')">
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

                <div class="vehicles-mobile-list d-lg-none">
                    @foreach ($viaturas as $viatura)
                        <div class="vehicle-mobile-card">
                            <div class="vehicle-mobile-image">
                                @if ($viatura->imagem_url)
                                    <img src="{{ $viatura->imagem_url }}"
                                        alt="{{ $viatura->marca }} {{ $viatura->modelo }}">
                                @else
                                    <div>Sem imagem</div>
                                @endif
                            </div>

                            <div class="p-3">
                                <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                                    <div>
                                        <h3 class="h6 fw-bold mb-1">
                                            {{ $viatura->marca }} {{ $viatura->modelo }}
                                        </h3>

                                        <p class="text-muted small mb-0">
                                            {{ $viatura->matricula }} · {{ $viatura->ano }}
                                        </p>
                                    </div>

                                    @if ($viatura->vendido)
                                        <span
                                            class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                            Vendida
                                        </span>
                                    @else
                                        <span
                                            class="badge bg-success-subtle text-success border border-success-subtle">
                                            Disponível
                                        </span>
                                    @endif
                                </div>

                                <div class="vehicle-mobile-info">
                                    <div>
                                        <span>Combustível</span>
                                        <strong>{{ $viatura->combustivel }}</strong>
                                    </div>

                                    <div>
                                        <span>Km</span>
                                        <strong>{{ number_format($viatura->quilometragem, 0, ',', '.') }} km</strong>
                                    </div>

                                    <div>
                                        <span>Cor</span>
                                        <strong>{{ $viatura->cor }}</strong>
                                    </div>

                                    <div>
                                        <span>Preço</span>
                                        <strong>{{ number_format($viatura->preco, 2, ',', '.') }} €</strong>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 mt-3">
                                    <a href="{{ route('viaturas.show', $viatura->id) }}" data-bs-toggle="tooltip"
                                        title="Ver detalhes" class="btn btn-action-view btn-sm flex-fill">
                                        Ver
                                    </a>

                                    @can('editar-viaturas')
                                        <a href="{{ route('viaturas.edit', $viatura->id) }}" data-bs-toggle="tooltip"
                                            title="Editar registo" class="btn btn-action-edit btn-sm flex-fill">
                                            Editar
                                        </a>
                                    @endcan
                                </div>

                                @can('eliminar-viaturas')
                                    <form action="{{ route('viaturas.destroy', $viatura->id) }}" method="POST"
                                        class="mt-2">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" data-bs-toggle="tooltip" title="Eliminar registo"
                                            class="btn btn-action-delete btn-sm w-100"
                                            onclick="return confirm('Tens a certeza que queres eliminar esta viatura?')">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4 mb-3">
                    {{ $viaturas->links() }}
                </div>
            @else
                <div class="dashboard-empty-state">
                    Não foram encontradas viaturas.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
