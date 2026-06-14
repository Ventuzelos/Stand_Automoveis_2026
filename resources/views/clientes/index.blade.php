<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2 class="fs-4 fw-bold mb-0">Lista de Clientes</h2>

            @can('criar-clientes')
                <a href="{{ route('clientes.create') }}" class="btn btn-primary">
                    Novo Cliente
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

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('clientes.index') }}" method="GET" class="mb-4">
                    <div class="search-unified">
                        <div class="search-unified-group search-unified-input-group">
                            <input type="text" name="search" class="search-unified-input"
                                placeholder="Pesquisar por nome, email ou telefone" value="{{ request('search') }}">

                            @if (request('search'))
                                <a href="{{ route('clientes.index') }}" class="search-unified-clear"
                                    aria-label="Limpar">
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

                @if ($clientes->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle clients-table">
                            <thead>
                                <tr>
                                    <th class="col-id">ID</th>
                                    <th class="col-name">Nome</th>
                                    <th class="col-email">Email</th>
                                    <th class="col-phone">Telefone</th>
                                    <th class="col-address">Morada</th>
                                    <th class="col-nif">NIF</th>
                                    <th class="text-center col-actions">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td>{{ $cliente->id }}</td>
                                        <td>
                                            <div class="table-text-limit table-name" title="{{ $cliente->nome }}">
                                                {{ $cliente->nome }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="table-text-limit table-email" title="{{ $cliente->email }}">
                                                {{ $cliente->email }}
                                            </div>
                                        </td>
                                        <td>{{ $cliente->telefone }}</td>
                                        <td>
                                            <div class="table-text-limit table-address" title="{{ $cliente->morada }}">
                                                {{ $cliente->morada }}
                                            </div>
                                        </td>
                                        <td>{{ $cliente->nif }}</td>
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
                                                    <form action="{{ route('clientes.destroy', $cliente->id) }}"
                                                        method="POST" class="d-inline m-0">
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

                    <div class="d-flex justify-content-center mt-4">
                        {{ $clientes->links() }}
                    </div>
                @else
                    <div class="alert alert-secondary mb-0">
                        Não foram encontrados clientes.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
