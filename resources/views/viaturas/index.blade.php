<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2 class="fs-4 fw-bold mb-0">Lista de Viaturas</h2>
            <a href="{{ route('viaturas.create') }}" class="btn btn-primary">
                Nova Viatura
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

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('viaturas.index') }}" method="GET" class="mb-4">
                    <div class="search-unified">
                        <div class="search-unified-group search-unified-input-group">
                            <input type="text" name="search" class="search-unified-input"
                                placeholder="Pesquisar por marca, modelo ou matrícula" value="{{ request('search') }}">

                            @if (request('search') || request('sort') || request('direction'))
                                <a href="{{ route('viaturas.index') }}" class="search-unified-clear"
                                    aria-label="Limpar">
                                    &times;
                                </a>
                            @endif
                        </div>

                        <div class="search-unified-separator"></div>

                        <div class="search-unified-group">
                            <select name="sort" class="search-unified-select">
                                <option value="id" {{ request('sort', 'id') == 'id' ? 'selected' : '' }}>ID</option>
                                <option value="marca" {{ request('sort') == 'marca' ? 'selected' : '' }}>Marca</option>
                                <option value="modelo" {{ request('sort') == 'modelo' ? 'selected' : '' }}>Modelo
                                </option>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="7"></circle>
                                <path d="m20 20-3.5-3.5"></path>
                            </svg>
                        </button>
                    </div>
                </form>

                @if ($viaturas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Imagem</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Matrícula</th>
                                    <th>Ano</th>
                                    <th>Cor</th>
                                    <th>Preço</th>
                                    <th>Combustível</th>
                                    <th>Km</th>
                                    <th>Estado</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viaturas as $viatura)
                                    <tr>
                                        <td>{{ $viatura->id }}</td>
                                        <td>
                                            @if ($viatura->imagem)
                                                <img src="{{ asset('storage/' . $viatura->imagem) }}"
                                                    alt="Imagem da viatura" width="72" height="48"
                                                    class="img-thumbnail">
                                            @else
                                                <span class="text-muted">Sem imagem</span>
                                            @endif
                                        </td>
                                        <td>{{ $viatura->marca }}</td>
                                        <td>{{ $viatura->modelo }}</td>
                                        <td>{{ $viatura->matricula }}</td>
                                        <td>{{ $viatura->ano }}</td>
                                        <td>{{ $viatura->cor }}</td>
                                        <td>{{ number_format($viatura->preco, 2, ',', '.') }} €</td>
                                        <td>{{ $viatura->combustivel }}</td>
                                        <td>{{ number_format($viatura->quilometragem, 0, ',', '.') }} km</td>
                                        <td>
                                            @if ($viatura->vendido)
                                                <span class="badge bg-danger">Vendida</span>
                                            @else
                                                <span class="badge bg-success">Disponível</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="d-inline-flex flex-wrap gap-2 justify-content-center">
                                                <a href="{{ route('viaturas.show', $viatura->id) }}"
                                                    class="btn btn-action-view btn-sm">
                                                    Ver
                                                </a>
                                                <a href="{{ route('viaturas.edit', $viatura->id) }}"
                                                    class="btn btn-action-edit btn-sm">
                                                    Editar
                                                </a>

                                                <form action="{{ route('viaturas.destroy', $viatura->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-action-delete btn-sm"
                                                        onclick="return confirm('Tens a certeza que queres eliminar esta viatura?')">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4 mb-3">
                        {{ $viaturas->links() }}
                    </div>
                @else
                    <div class="alert alert-secondary mb-0">
                        Não foram encontradas viaturas.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
