<x-app-layout>
    <x-slot name="header">
        <div>
            <x-breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Viaturas', 'url' => route('viaturas.index')],
                ['label' => $viatura->marca . ' ' . $viatura->modelo],
            ]" />
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="dashboard-kicker">Perfil da viatura</span>
                <h2 class="fs-4 fw-bold mb-0">
                    {{ $viatura->marca }} {{ $viatura->modelo }}
                </h2>
                <p class="text-muted mb-0">
                    Informação comercial, técnica e estado atual da viatura.
                </p>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('viaturas.index') }}" class="btn btn-outline-secondary">
                    Voltar
                </a>

                @can('editar-viaturas')
                    <a href="{{ route('viaturas.edit', $viatura->id) }}" class="btn btn-primary">
                        Editar Viatura
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row g-4 mb-4">
            <div class="col-lg-5">
                <div class="dashboard-card h-100 overflow-hidden p-0">
                    <div class="vehicle-profile-image">
                        @if ($viatura->imagem_url)
                            <img src="{{ $viatura->imagem_url }}" alt="{{ $viatura->marca }} {{ $viatura->modelo }}">
                        @else
                            <div class="vehicle-profile-placeholder">
                                Sem imagem
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
                            <div>
                                <span class="dashboard-label">Estado atual</span>
                                <div class="mt-1">
                                    @if ($viatura->vendido)
                                        <span
                                            class="badge bg-warning-subtle text-warning border border-warning-subtle px-3 py-2">
                                            Vendida
                                        </span>
                                    @else
                                        <span
                                            class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">
                                            Disponível
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="text-end">
                                <span class="dashboard-label">Matrícula</span>
                                <strong class="d-block">{{ $viatura->matricula }}</strong>
                            </div>
                        </div>

                        <div class="vehicle-price-box">
                            <span>Preço anunciado</span>
                            <strong>{{ number_format($viatura->preco, 2, ',', '.') }} €</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="dashboard-card h-100">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">
                        <div>
                            <span class="dashboard-kicker">Ficha comercial</span>
                            <h3 class="h4 fw-bold mb-1">
                                {{ $viatura->marca }} {{ $viatura->modelo }}
                            </h3>
                            <p class="text-muted mb-0">
                                {{ $viatura->ano }} · {{ number_format($viatura->quilometragem, 0, ',', '.') }} km ·
                                {{ $viatura->combustivel }}
                            </p>
                        </div>

                        <span class="badge bg-light text-dark border px-3 py-2">
                            ID #{{ $viatura->id }}
                        </span>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="vehicle-profile-spec">
                                <span>Marca</span>
                                <strong>{{ $viatura->marca }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="vehicle-profile-spec">
                                <span>Modelo</span>
                                <strong>{{ $viatura->modelo }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="vehicle-profile-spec">
                                <span>Ano</span>
                                <strong>{{ $viatura->ano }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="vehicle-profile-spec">
                                <span>Cor</span>
                                <strong>{{ $viatura->cor }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="vehicle-profile-spec">
                                <span>Combustível</span>
                                <strong>{{ $viatura->combustivel }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="vehicle-profile-spec">
                                <span>Quilometragem</span>
                                <strong>{{ number_format($viatura->quilometragem, 0, ',', '.') }} km</strong>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4 flex-wrap">
                        @can('gerir-vendas')
                            @if (!$viatura->vendido)
                                <a href="{{ route('vendas.create') }}" class="btn btn-success">
                                    Registar Venda
                                </a>
                            @endif
                        @endcan

                        @can('eliminar-viaturas')
                            <form action="{{ route('viaturas.destroy', $viatura->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Tens a certeza que queres eliminar esta viatura?')">
                                    Eliminar
                                </button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6">
                <div class="dashboard-panel h-100">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Informação Técnica</h4>
                            <p class="dashboard-panel-subtitle">Características principais da viatura</p>
                        </div>
                    </div>

                    <div class="dashboard-summary-list">
                        <div class="dashboard-summary-item">
                            <span>Matrícula</span>
                            <strong>{{ $viatura->matricula }}</strong>
                        </div>

                        <div class="dashboard-summary-item">
                            <span>Ano</span>
                            <strong>{{ $viatura->ano }}</strong>
                        </div>

                        <div class="dashboard-summary-item">
                            <span>Combustível</span>
                            <strong>{{ $viatura->combustivel }}</strong>
                        </div>

                        <div class="dashboard-summary-item">
                            <span>Cor</span>
                            <strong>{{ $viatura->cor }}</strong>
                        </div>

                        <div class="dashboard-summary-item">
                            <span>Quilometragem</span>
                            <strong>{{ number_format($viatura->quilometragem, 0, ',', '.') }} km</strong>
                        </div>

                        <div class="dashboard-summary-item">
                            <span>Preço</span>
                            <strong>{{ number_format($viatura->preco, 2, ',', '.') }} €</strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="dashboard-panel h-100">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Histórico Comercial</h4>
                            <p class="dashboard-panel-subtitle">Estado de venda e associação comercial</p>
                        </div>
                    </div>

                    @if ($viatura->venda)
                        <div class="vehicle-sale-card">
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                <div>
                                    <span class="dashboard-label">Venda associada</span>
                                    <h5 class="fw-bold mb-1">
                                        {{ $viatura->venda->cliente->nome ?? 'Cliente não disponível' }}
                                    </h5>
                                    <p class="text-muted mb-0">
                                        {{ \Carbon\Carbon::parse($viatura->venda->data_venda)->format('d/m/Y') }}
                                    </p>
                                </div>

                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                    Vendida
                                </span>
                            </div>

                            <div class="vehicle-price-box">
                                <span>Valor da venda</span>
                                <strong>{{ number_format($viatura->venda->preco_venda, 2, ',', '.') }} €</strong>
                            </div>

                            @if ($viatura->venda->observacoes)
                                <div class="mt-3 text-muted">
                                    {{ $viatura->venda->observacoes }}
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="dashboard-empty-state">
                            Esta viatura ainda não tem venda associada.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
