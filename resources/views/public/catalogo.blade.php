@extends('public.layouts.app')

@section('title', 'UrbanMotors - Catálogo')
@section('metaDescription', 'Consulte o catálogo público de viaturas disponíveis na UrbanMotors.')

@section('content')
    <section class="py-5 bg-light border-bottom">
        <div class="container">
            <div class="row g-3 align-items-end">
                <div class="col-lg-8">
                    <h1 class="section-title mb-2">Catálogo de Viaturas</h1>
                    <p class="section-text mb-0">
                        Explore as viaturas disponíveis e utilize os filtros para encontrar a opção certa.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2">
                        {{ $viaturas->total() }} resultado(s)
                    </span>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    <div class="public-info-card position-sticky" style="top: 100px;">
                        <div class="card-body p-4">
                            <h2 class="h5 fw-bold mb-3">Filtros</h2>

                            <form method="GET" action="{{ route('catalogo.index') }}">
                                <div class="mb-3">
                                    <label for="pesquisa" class="form-label">Pesquisa</label>
                                    <input type="text" name="pesquisa" id="pesquisa" class="form-control"
                                        value="{{ request('pesquisa') }}" placeholder="Marca, modelo, cor...">
                                </div>

                                <div class="mb-3">
                                    <label for="marca" class="form-label">Marca</label>
                                    <select name="marca" id="marca" class="form-select">
                                        <option value="">Todas</option>
                                        @foreach ($marcas as $itemMarca)
                                            <option value="{{ $itemMarca }}"
                                                {{ request('marca') == $itemMarca ? 'selected' : '' }}>
                                                {{ $itemMarca }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="modelo" class="form-label">Modelo</label>
                                    <input type="text" name="modelo" id="modelo" class="form-control"
                                        value="{{ request('modelo') }}" placeholder="Ex: A3, Série 1...">
                                </div>

                                <div class="mb-3">
                                    <label for="ano" class="form-label">Ano</label>
                                    <select name="ano" id="ano" class="form-select">
                                        <option value="">Todos</option>
                                        @foreach ($anos as $itemAno)
                                            <option value="{{ $itemAno }}"
                                                {{ request('ano') == $itemAno ? 'selected' : '' }}>
                                                {{ $itemAno }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row g-2 mb-3">
                                    <div class="col-6">
                                        <label for="preco_min" class="form-label">Preço mín.</label>
                                        <input type="number" name="preco_min" id="preco_min" class="form-control"
                                            value="{{ request('preco_min') }}" min="0" step="0.01">
                                    </div>

                                    <div class="col-6">
                                        <label for="preco_max" class="form-label">Preço máx.</label>
                                        <input type="number" name="preco_max" id="preco_max" class="form-control"
                                            value="{{ request('preco_max') }}" min="0" step="0.01">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="ordenar" class="form-label">Ordenar por</label>
                                    <select name="ordenar" id="ordenar" class="form-select">
                                        <option value="recentes"
                                            {{ request('ordenar', 'recentes') == 'recentes' ? 'selected' : '' }}>
                                            Mais recentes
                                        </option>
                                        <option value="preco_asc"
                                            {{ request('ordenar') == 'preco_asc' ? 'selected' : '' }}>
                                            Preço mais baixo
                                        </option>
                                        <option value="preco_desc"
                                            {{ request('ordenar') == 'preco_desc' ? 'selected' : '' }}>
                                            Preço mais alto
                                        </option>
                                        <option value="ano_desc" {{ request('ordenar') == 'ano_desc' ? 'selected' : '' }}>
                                            Ano mais recente
                                        </option>
                                        <option value="ano_asc" {{ request('ordenar') == 'ano_asc' ? 'selected' : '' }}>
                                            Ano mais antigo
                                        </option>
                                    </select>
                                </div>

                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        Aplicar filtros
                                    </button>

                                    <a href="{{ route('catalogo.index') }}" class="btn btn-outline-secondary">
                                        Limpar
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    @if (request()->filled('pesquisa') ||
                            request()->filled('marca') ||
                            request()->filled('modelo') ||
                            request()->filled('ano') ||
                            request()->filled('preco_min') ||
                            request()->filled('preco_max'))
                        <div class="mb-4">
                            <div class="alert alert-secondary">
                                A visualizar resultados filtrados do catálogo.
                            </div>
                        </div>
                    @endif

                    @if ($viaturas->count() > 0)
                        <div class="row g-4">
                            @foreach ($viaturas as $viatura)
                                <div class="col-md-6 col-xl-4">
                                    <div class="vehicle-card h-100 overflow-hidden">
                                        @if ($viatura->imagem)
                                            <img src="{{ asset('storage/' . $viatura->imagem) }}"
                                                alt="{{ $viatura->marca }} {{ $viatura->modelo }}" class="vehicle-image">
                                        @else
                                            <div
                                                class="vehicle-image d-flex align-items-center justify-content-center text-muted">
                                                Sem imagem
                                            </div>
                                        @endif

                                        <div class="p-4 d-flex flex-column h-100">
                                            <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                                                <div>
                                                    <h2 class="h5 fw-bold mb-1">
                                                        {{ $viatura->marca }} {{ $viatura->modelo }}
                                                    </h2>
                                                    <div class="vehicle-meta">
                                                        {{ $viatura->ano }} ·
                                                        {{ number_format($viatura->quilometragem, 0, ',', '.') }} km
                                                    </div>
                                                </div>

                                                <span class="badge bg-success">Disponível</span>
                                            </div>

                                            <div class="vehicle-meta mb-2">
                                                {{ $viatura->combustivel }} · {{ $viatura->cor }}
                                            </div>

                                            <div class="vehicle-price mb-4">
                                                {{ number_format($viatura->preco, 2, ',', '.') }} €
                                            </div>

                                            <div class="mt-auto">
                                                <a href="{{ route('catalogo.show', $viatura->id) }}"
                                                    class="btn btn-primary w-100">
                                                    Ver detalhes
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="pagination-wrapper">
                            <div class="pagination-summary">
                                Página {{ $viaturas->currentPage() }} de {{ $viaturas->lastPage() }}
                            </div>

                            <div>
                                {{ $viaturas->links() }}
                            </div>
                        </div>
                    @else
                        <div class="alert alert-secondary mb-0">
                            Não foram encontradas viaturas com os filtros selecionados.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
