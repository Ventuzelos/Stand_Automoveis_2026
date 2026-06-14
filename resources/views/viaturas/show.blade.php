<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2 class="fs-4 fw-bold mb-0">Detalhes da Viatura</h2>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="card-body">
            <div class="row g-4">
                <div class="col-lg-5">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            @if ($viatura->imagem)
                                <img src="{{ asset('storage/' . $viatura->imagem) }}" alt="Imagem da viatura"
                                    class="img-fluid rounded w-100">
                            @else
                                <div class="border rounded d-flex align-items-center justify-content-center text-muted"
                                    style="height: 320px;">
                                    Sem imagem
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h3 class="h4 fw-bold mb-4">
                                {{ $viatura->marca }} {{ $viatura->modelo }}
                            </h3>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted d-block mb-1">ID</small>
                                        <strong>{{ $viatura->id }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted d-block mb-1">Matrícula</small>
                                        <strong>{{ $viatura->matricula }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted d-block mb-1">Ano</small>
                                        <strong>{{ $viatura->ano }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted d-block mb-1">Cor</small>
                                        <strong>{{ $viatura->cor }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted d-block mb-1">Combustível</small>
                                        <strong>{{ $viatura->combustivel }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted d-block mb-1">Quilometragem</small>
                                        <strong>{{ number_format($viatura->quilometragem, 0, ',', '.') }} km</strong>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted d-block mb-1">Preço</small>
                                        <strong>{{ number_format($viatura->preco, 2, ',', '.') }} €</strong>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="border rounded p-3 h-100">
                                        <small class="text-muted d-block mb-1">Estado</small>
                                        @if ($viatura->vendido)
                                            <span class="badge bg-danger">Vendida</span>
                                        @else
                                            <span class="badge bg-success">Disponível</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4 flex-wrap">
                                <a href="{{ route('viaturas.index') }}" class="btn btn-outline-secondary">
                                    Voltar à Lista
                                </a>

                                @can('editar-viaturas')
                                    <a href="{{ route('viaturas.edit', $viatura->id) }}" class="btn btn-primary">
                                        Editar Viatura
                                    </a>
                                @endcan

                                @can('eliminar-viaturas')
                                    <form action="{{ route('viaturas.destroy', $viatura->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Tens a certeza que queres eliminar esta viatura?')">
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
    </div>
</x-app-layout>
