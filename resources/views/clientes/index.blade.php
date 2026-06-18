<x-app-layout>
    <x-slot name="header">
        <div>
            <x-breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('dashboard')], ['label' => 'Clientes']]" />
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="dashboard-kicker">Gestão de clientes</span>
                <h2 class="fs-4 fw-bold mb-0">Lista de Clientes</h2>
                <p class="text-muted mb-0">Consulta, pesquisa e gestão da base de clientes.</p>
            </div>
            <div>
                @can('criar-clientes')
                    <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                        Novo Cliente
                    </a>
                @endcan
                <a href="{{ route('export.clientes') }}" class="btn btn-outline-secondary">
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
            <div class="col-md-4">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Total de Clientes</span>
                            <h3>{{ $totalClientes }}</h3>
                            <small class="dashboard-meta">Clientes registados</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Com Compras</span>
                            <h3>{{ $clientesComCompras }}</h3>
                            <small class="dashboard-meta">Clientes com vendas associadas</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-bag-check"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="dashboard-card dashboard-stat-card h-100">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Sem Compras</span>
                            <h3>{{ $clientesSemCompras }}</h3>
                            <small class="dashboard-meta">Ainda sem vendas registadas</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-person-dash"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h4 class="dashboard-panel-title">Base de clientes</h4>
                    <p class="dashboard-panel-subtitle">
                        Pesquisa por nome, email, telefone, NIF ou morada.
                    </p>
                </div>
            </div>

            <form action="{{ route('clientes.index') }}" method="GET" class="mb-4">
                <div class="search-unified">
                    <div class="search-unified-group search-unified-input-group">
                        <input type="text" name="search" class="search-unified-input"
                            placeholder="Pesquisar por nome, email, telefone, NIF ou morada"
                            value="{{ request('search') }}">

                        @if (request('search'))
                            <a href="{{ route('clientes.index') }}" class="search-unified-clear" aria-label="Limpar">
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

            @if ($clientes->count() > 0)
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-hover align-middle clients-table mb-0">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Email</th>
                                <th>Telefone</th>
                                <th>NIF</th>
                                <th>Morada</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($clientes as $cliente)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="client-table-avatar">
                                                {{ strtoupper(substr($cliente->nome, 0, 1)) }}
                                            </div>

                                            <div>
                                                <strong class="d-block">{{ $cliente->nome }}</strong>
                                                <small class="text-muted">Cliente #{{ $cliente->id }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="table-text-limit table-email" title="{{ $cliente->email }}">
                                            {{ $cliente->email }}
                                        </div>
                                    </td>

                                    <td>{{ $cliente->telefone }}</td>

                                    <td>
                                        <span class="badge bg-light text-dark border">
                                            {{ $cliente->nif }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="table-text-limit table-address" title="{{ $cliente->morada }}">
                                            {{ $cliente->morada }}
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <div class="table-actions">
                                            <a href="{{ route('clientes.show', $cliente->id) }}"
                                                class="btn btn-action-view btn-sm">
                                                Ver
                                            </a>

                                            @can('editar-clientes')
                                                <a href="{{ route('clientes.edit', $cliente->id) }}"
                                                    class="btn btn-action-edit btn-sm">
                                                    Editar
                                                </a>
                                            @endcan

                                            @can('eliminar-clientes')
                                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                                                    class="d-inline m-0">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-action-delete btn-sm"
                                                        onclick="return confirm('Tens a certeza que queres eliminar este cliente?')">
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
                {{-- responsivo --}}
                <div class="clients-mobile-list d-lg-none">
                    @foreach ($clientes as $cliente)
                        <div class="client-mobile-card mb-3">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <div class="client-table-avatar">
                                    {{ strtoupper(substr($cliente->nome, 0, 1)) }}
                                </div>

                                <div class="flex-grow-1">
                                    <h3 class="h6 fw-bold mb-1">
                                        {{ $cliente->nome }}
                                    </h3>

                                    <p class="text-muted small mb-0">
                                        Cliente #{{ $cliente->id }}
                                    </p>
                                </div>
                            </div>

                            <div class="client-mobile-info">
                                <div>
                                    <span>Email</span>
                                    <strong>{{ $cliente->email }}</strong>
                                </div>

                                <div>
                                    <span>Telefone</span>
                                    <strong>{{ $cliente->telefone }}</strong>
                                </div>

                                <div>
                                    <span>NIF</span>
                                    <strong>{{ $cliente->nif }}</strong>
                                </div>

                                <div>
                                    <span>Morada</span>
                                    <strong>{{ $cliente->morada }}</strong>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('clientes.show', $cliente->id) }}"
                                    class="btn btn-action-view btn-sm flex-fill">
                                    Ver
                                </a>

                                @can('editar-clientes')
                                    <a href="{{ route('clientes.edit', $cliente->id) }}"
                                        class="btn btn-action-edit btn-sm flex-fill">
                                        Editar
                                    </a>
                                @endcan
                            </div>

                            @can('eliminar-clientes')
                                <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                                    class="mt-2">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-action-delete btn-sm w-100"
                                        onclick="return confirm('Tens a certeza que queres eliminar este cliente?')">
                                        Eliminar
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $clientes->links() }}
                </div>
            @else
                <div class="dashboard-empty-state">
                    Não foram encontrados clientes.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
