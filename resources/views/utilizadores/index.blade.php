<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <x-breadcrumbs :items="[['label' => 'Dashboard', 'url' => route('dashboard')], ['label' => 'Utilizadores']]" />

                <span class="dashboard-kicker">Administração</span>
                <h2 class="fs-4 fw-bold mb-0">Lista de Utilizadores</h2>
                <p class="text-muted mb-0">
                    Gestão de acessos, permissões e contas internas.
                </p>
            </div>

            @can('criar-utilizadores')
                <a href="{{ route('utilizadores.create') }}" class="btn btn-primary">
                    Novo Utilizador
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="container py-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h4 class="dashboard-panel-title">Utilizadores do sistema</h4>
                    <p class="dashboard-panel-subtitle">
                        Pesquisa por nome, email ou role.
                    </p>
                </div>
            </div>

            <form action="{{ route('utilizadores.index') }}" method="GET" class="mb-4">
                <div class="search-unified">
                    <div class="search-unified-group search-unified-input-group">
                        <input type="text" name="search" class="search-unified-input"
                            placeholder="Pesquisar por nome, email ou role" value="{{ request('search') }}">

                        @if (request('search'))
                            <a href="{{ route('utilizadores.index') }}" class="search-unified-clear"
                                aria-label="Limpar">
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

            @if ($utilizadores->count() > 0)
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-hover align-middle users-table mb-0">
                        <thead>
                            <tr>
                                <th>Utilizador</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Email verificado</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($utilizadores as $utilizador)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="user-table-avatar">
                                                {{ strtoupper(substr($utilizador->name, 0, 1)) }}
                                            </div>

                                            <div>
                                                <strong class="d-block">{{ $utilizador->name }}</strong>
                                                <small class="text-muted">Utilizador #{{ $utilizador->id }}</small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $utilizador->email }}</td>

                                    <td>
                                        @if ($utilizador->role === 'admin')
                                            <span class="badge bg-dark">Admin</span>
                                        @else
                                            <span class="badge bg-secondary">Vendedor</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($utilizador->email_verified_at)
                                            <span
                                                class="badge bg-success-subtle text-success border border-success-subtle">
                                                Sim
                                            </span>
                                        @else
                                            <span
                                                class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                                Não
                                            </span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="table-actions">
                                            <a href="{{ route('utilizadores.show', $utilizador->id) }}"
                                                data-bs-toggle="tooltip" title="Ver detalhes"
                                                class="btn btn-action-view btn-sm">
                                                Ver
                                            </a>

                                            <a href="{{ route('utilizadores.edit', $utilizador->id) }}"
                                                data-bs-toggle="tooltip" title="Editar registo"
                                                class="btn btn-action-edit btn-sm">
                                                Editar
                                            </a>

                                            @if (auth()->id() !== $utilizador->id)
                                                <form action="{{ route('utilizadores.destroy', $utilizador->id) }}"
                                                    method="POST" class="d-inline m-0">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-action-delete btn-sm"
                                                        data-bs-toggle="tooltip" title="Eliminar registo"
                                                        onclick="return confirm('Tens a certeza que queres eliminar este utilizador?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="users-mobile-list d-lg-none">
                    @foreach ($utilizadores as $utilizador)
                        <div class="user-mobile-card">
                            <div class="d-flex align-items-start gap-3 mb-3">
                                <div class="user-table-avatar">
                                    {{ strtoupper(substr($utilizador->name, 0, 1)) }}
                                </div>

                                <div class="flex-grow-1">
                                    <h3 class="h6 fw-bold mb-1">
                                        {{ $utilizador->name }}
                                    </h3>

                                    <p class="text-muted small mb-0">
                                        Utilizador #{{ $utilizador->id }}
                                    </p>
                                </div>

                                @if ($utilizador->role === 'admin')
                                    <span class="badge bg-dark">Admin</span>
                                @else
                                    <span class="badge bg-secondary">Vendedor</span>
                                @endif
                            </div>

                            <div class="user-mobile-info">
                                <div>
                                    <span>Email</span>
                                    <strong>{{ $utilizador->email }}</strong>
                                </div>

                                <div>
                                    <span>Email verificado</span>
                                    <strong>
                                        {{ $utilizador->email_verified_at ? 'Sim' : 'Não' }}
                                    </strong>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('utilizadores.show', $utilizador->id) }}"
                                    class="btn btn-action-view btn-sm flex-fill" data-bs-toggle="tooltip"
                                    title="Ver detalhes>
                                    Ver
                                </a>

                                <a href="{{ route('utilizadores.edit', $utilizador->id) }}"
                                    data-bs-toggle="tooltip" title="Editar registo"
                                    class="btn btn-action-edit btn-sm flex-fill">
                                    Editar
                                </a>
                            </div>

                            @if (auth()->id() !== $utilizador->id)
                                <form action="{{ route('utilizadores.destroy', $utilizador->id) }}" method="POST"
                                    class="mt-2">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-action-delete btn-sm w-100"
                                        data-bs-toggle="tooltip" title="Eliminar registo"
                                        onclick="return confirm('Tens a certeza que queres eliminar este utilizador?')">
                                        Eliminar
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $utilizadores->links() }}
                </div>
            @else
                <div class="dashboard-empty-state">
                    Não foram encontrados utilizadores.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
