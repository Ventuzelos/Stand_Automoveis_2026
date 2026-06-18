<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="dashboard-kicker">Registo comercial</span>
                <h2 class="fs-4 fw-bold mb-0">Venda #{{ $venda->id }}</h2>
                <p class="text-muted mb-0">
                    Detalhes da operação, cliente associado e viatura vendida.
                </p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('vendas.index') }}" class="btn btn-outline-secondary">
                    Voltar
                </a>

                @can('editar-vendas')
                    <a href="{{ route('vendas.edit', $venda->id) }}" class="btn btn-primary">
                        Editar Venda
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row g-4 mb-4">
            <div class="col-lg-4">
                <div class="dashboard-card h-100">
                    <div class="text-center">
                        <div class="sale-avatar mx-auto mb-3">
                            <i class="bi bi-receipt"></i>
                        </div>

                        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 mb-3">
                            Venda concluída
                        </span>

                        <h3 class="h4 fw-bold mb-1">
                            Venda #{{ $venda->id }}
                        </h3>

                        <p class="text-muted mb-0">
                            {{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}
                        </p>
                    </div>

                    <hr class="my-4">

                    <div class="sale-value-box">
                        <span>Valor da venda</span>
                        <strong>{{ number_format($venda->preco_venda, 2, ',', '.') }} €</strong>
                    </div>

                    <div class="client-contact-list mt-4">
                        <div class="client-contact-item">
                            <span>ID da venda</span>
                            <strong>#{{ $venda->id }}</strong>
                        </div>

                        <div class="client-contact-item">
                            <span>Data</span>
                            <strong>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</strong>
                        </div>

                        <div class="client-contact-item">
                            <span>Estado</span>
                            <strong>Concluída</strong>
                        </div>
                    </div>

                    @can('eliminar-vendas')
                        <form action="{{ route('vendas.destroy', $venda->id) }}" method="POST" class="mt-4">
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-outline-danger w-100"
                                onclick="return confirm('Tens a certeza que queres eliminar esta venda?')"
                            >
                                Eliminar Venda
                            </button>
                        </form>
                    @endcan
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="dashboard-card dashboard-stat-card h-100">
                            <span class="dashboard-label">Cliente</span>
                            <h3 class="h5 mb-1">{{ $venda->cliente->nome ?? '—' }}</h3>
                            <small class="dashboard-meta">
                                {{ $venda->cliente->email ?? 'Sem email associado' }}
                            </small>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="dashboard-card dashboard-stat-card h-100">
                            <span class="dashboard-label">Viatura</span>
                            <h3 class="h5 mb-1">
                                {{ $venda->viatura->marca ?? '' }}
                                {{ $venda->viatura->modelo ?? '' }}
                            </h3>
                            <small class="dashboard-meta">
                                {{ $venda->viatura->matricula ?? 'Sem matrícula' }}
                            </small>
                        </div>
                    </div>
                </div>

                <div class="dashboard-panel mb-4">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Informação do Cliente</h4>
                            <p class="dashboard-panel-subtitle">Dados associados ao comprador</p>
                        </div>

                        @if ($venda->cliente)
                            <a href="{{ route('clientes.show', $venda->cliente->id) }}" class="btn btn-sm btn-outline-secondary">
                                Ver cliente
                            </a>
                        @endif
                    </div>

                    @if ($venda->cliente)
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="sale-info-card">
                                    <span>Nome</span>
                                    <strong>{{ $venda->cliente->nome }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="sale-info-card">
                                    <span>Email</span>
                                    <strong>{{ $venda->cliente->email }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="sale-info-card">
                                    <span>Telefone</span>
                                    <strong>{{ $venda->cliente->telefone }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="sale-info-card">
                                    <span>NIF</span>
                                    <strong>{{ $venda->cliente->nif }}</strong>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="dashboard-empty-state">
                            Cliente não disponível.
                        </div>
                    @endif
                </div>

                <div class="dashboard-panel mb-4">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Informação da Viatura</h4>
                            <p class="dashboard-panel-subtitle">Dados da viatura vendida</p>
                        </div>

                        @if ($venda->viatura)
                            <a href="{{ route('viaturas.show', $venda->viatura->id) }}" class="btn btn-sm btn-outline-secondary">
                                Ver viatura
                            </a>
                        @endif
                    </div>

                    @if ($venda->viatura)
                        <div class="row g-3 align-items-stretch">
                            <div class="col-md-5">
                                <div class="sale-vehicle-image">
                                    @if ($venda->viatura->imagem_url)
                                        <img
                                            src="{{ $venda->viatura->imagem_url }}"
                                            alt="{{ $venda->viatura->marca }} {{ $venda->viatura->modelo }}"
                                        >
                                    @else
                                        <div>Sem imagem</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="row g-3">
                                    <div class="col-sm-6">
                                        <div class="sale-info-card">
                                            <span>Marca</span>
                                            <strong>{{ $venda->viatura->marca }}</strong>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="sale-info-card">
                                            <span>Modelo</span>
                                            <strong>{{ $venda->viatura->modelo }}</strong>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="sale-info-card">
                                            <span>Matrícula</span>
                                            <strong>{{ $venda->viatura->matricula }}</strong>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="sale-info-card">
                                            <span>Ano</span>
                                            <strong>{{ $venda->viatura->ano }}</strong>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="sale-info-card">
                                            <span>Quilómetros</span>
                                            <strong>{{ number_format($venda->viatura->quilometragem, 0, ',', '.') }} km</strong>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="sale-info-card">
                                            <span>Combustível</span>
                                            <strong>{{ $venda->viatura->combustivel }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="dashboard-empty-state">
                            Viatura não disponível.
                        </div>
                    @endif
                </div>

                <div class="dashboard-panel">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Observações</h4>
                            <p class="dashboard-panel-subtitle">Notas internas sobre a venda</p>
                        </div>
                    </div>

                    <div class="sale-notes">
                        {{ $venda->observacoes ?: 'Sem observações registadas.' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
