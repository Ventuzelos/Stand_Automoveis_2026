<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2 class="fs-4 fw-bold mb-0">Lista de Vendas</h2>

            @can('criar-vendas')
                <a href="{{ route('vendas.create') }}" class="btn btn-primary">
                    Nova Venda
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
                @if ($vendas->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cliente</th>
                                    <th>Viatura</th>
                                    <th>Data da Venda</th>
                                    <th>Valor da Venda</th>
                                    <th>Observações</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vendas as $venda)
                                    <tr>
                                        <td>{{ $venda->id }}</td>
                                        <td>{{ $venda->cliente->nome ?? 'Sem cliente' }}</td>
                                        <td>
                                            {{ $venda->viatura->marca ?? '' }}
                                            {{ $venda->viatura->modelo ?? '' }}
                                            @if ($venda->viatura && $venda->viatura->matricula)
                                                ({{ $venda->viatura->matricula }})
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</td>
                                        <td>{{ number_format($venda->preco_venda, 2, ',', '.') }} €</td>
                                        <td>{{ $venda->observacoes ?? '—' }}</td>
                                        <td class="text-center">
                                            <div class="d-inline-flex flex-wrap gap-2 justify-content-center">
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
                                                        class="d-inline">
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

                    <div class="d-flex justify-content-center mt-4">
                        {{ $vendas->links() }}
                    </div>
                @else
                    <div class="alert alert-secondary mb-0">
                        Não foram encontradas vendas.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
