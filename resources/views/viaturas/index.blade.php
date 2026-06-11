<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
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
                @if ($viaturas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Imagem</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Matrícula</th>
                                    <th>Ano</th>
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
                                                    alt="Imagem da viatura" width="80" class="img-thumbnail">
                                            @else
                                                <span class="text-muted">Sem imagem</span>
                                            @endif
                                        </td>
                                        <td>{{ $viatura->marca }}</td>
                                        <td>{{ $viatura->modelo }}</td>
                                        <td>{{ $viatura->matricula }}</td>
                                        <td>{{ $viatura->ano }}</td>
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
                                            <a href="{{ route('viaturas.edit', $viatura->id) }}"
                                                class="btn btn-warning btn-sm">
                                                Editar
                                            </a>

                                            <form action="{{ route('viaturas.destroy', $viatura->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Tens a certeza que queres eliminar esta viatura?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-4">
                            {{ $viaturas->links() }}
                        </div>
                    </div>
                @else
                    <div class="alert alert-secondary mb-0">
                        Ainda não existem viaturas registadas.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
