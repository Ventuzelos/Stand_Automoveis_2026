<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2 class="fs-4 fw-bold mb-0">Detalhes da Venda</h2>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="card-body">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="h4 fw-bold mb-4">Venda #{{ $venda->id }}</h3>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">ID da Venda</small>
                                    <strong>{{ $venda->id }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Data da Venda</small>
                                    <strong>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Cliente</small>
                                    <strong>{{ $venda->cliente->nome ?? '—' }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Viatura</small>
                                    <strong>
                                        {{ $venda->viatura->marca ?? '' }}
                                        {{ $venda->viatura->modelo ?? '' }}
                                        @if ($venda->viatura)
                                            ({{ $venda->viatura->matricula }})
                                        @endif
                                    </strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Preço da Venda</small>
                                    <strong>{{ number_format($venda->preco_venda, 2, ',', '.') }} €</strong>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Observações</small>
                                    <strong>{{ $venda->observacoes ?: 'Sem observações.' }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('vendas.index') }}" class="btn btn-outline-secondary">
                                Voltar à Lista
                            </a>

                            @can('editar-vendas')
                                <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-primary">
                                    Editar Venda
                                </a>
                            @endcan

                            @can('eliminar-vendas')
                                <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Tens a certeza que queres eliminar esta venda?')">
                                        Eliminar
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
