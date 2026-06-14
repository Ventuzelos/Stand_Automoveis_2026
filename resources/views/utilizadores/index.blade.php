<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2 class="fs-4 fw-bold mb-0">Lista de Utilizadores</h2>
            <a href="{{ route('utilizadores.create') }}" class="btn btn-primary">
                Novo Utilizador
            </a>
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

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('utilizadores.index') }}" method="GET" class="mb-4">
                    <div class="search-unified">
                        <div class="search-unified-group search-unified-input-group">
                            <input
                                type="text"
                                name="search"
                                class="search-unified-input"
                                placeholder="Pesquisar por nome, email ou role"
                                value="{{ request('search') }}"
                            >

                            @if (request('search'))
                                <a href="{{ route('utilizadores.index') }}" class="search-unified-clear" aria-label="Limpar">
                                    &times;
                                </a>
                            @endif
                        </div>

                        <div class="search-unified-separator"></div>

                        <button type="submit" class="search-unified-submit" aria-label="Pesquisar">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7"></circle>
                                <path d="m20 20-3.5-3.5"></path>
                            </svg>
                        </button>
                    </div>
                </form>

                @if ($utilizadores->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Email verificado</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($utilizadores as $utilizador)
                                    <tr>
                                        <td>{{ $utilizador->id }}</td>
                                        <td>{{ $utilizador->name }}</td>
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
                                                <span class="badge bg-success">Sim</span>
                                            @else
                                                <span class="badge bg-warning text-dark">Não</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex flex-wrap gap-2 justify-content-center">
                                                <a href="{{ route('utilizadores.show', $utilizador->id) }}"
                                                    class="btn btn-action-view btn-sm">
                                                    Ver
                                                </a>

                                                <a href="{{ route('utilizadores.edit', $utilizador->id) }}"
                                                    class="btn btn-action-edit btn-sm">
                                                    Editar
                                                </a>

                                                @if (auth()->id() !== $utilizador->id)
                                                    <form action="{{ route('utilizadores.destroy', $utilizador->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-action-delete btn-sm"
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

                    <div class="d-flex justify-content-center mt-4">
                        {{ $utilizadores->links() }}
                    </div>
                @else
                    <div class="alert alert-secondary mb-0">
                        Não foram encontrados utilizadores.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
