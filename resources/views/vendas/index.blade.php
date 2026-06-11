<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fs-4 fw-bold mb-0">Lista de Vendas</h2>
            <a href="{{ route('vendas.create') }}" class="btn btn-primary">
                Nova Venda
            </a>
        </div>
    </x-slot>

    <div class="container py-4">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                @if($vendas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Viatura</th>
                                    <th>Matrícula</th>
                                    <th>Data da Venda</th>
                                    <th>Valor da Venda</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vendas as $venda)
                                    <tr>
                                        <td>{{ $venda->id }}</td>
                                        <td>{{ $venda->cliente->nome ?? '—' }}</td>
                                        <td>{{ $venda->viatura->marca ?? '—' }} {{ $venda->viatura->modelo ?? '' }}</td>
                                        <td>{{ $venda->viatura->matricula ?? '—' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</td>
                                        <td>{{ number_format($venda->preco_venda, 2, ',', '.') }} €</td>
                                        <td class="text-center">
                                            <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-warning btn-sm">
                                                Editar
                                            </a>

                                            <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tens a certeza que queres eliminar esta venda?')">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-secondary mb-0">
                        Ainda não existem vendas registadas.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
