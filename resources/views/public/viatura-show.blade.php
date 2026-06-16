@extends('public.layouts.app')

@section('title', $viatura->marca . ' ' . $viatura->modelo . ' - UrbanMotors')
@section('metaDescription',
    'Consulte os detalhes da viatura ' .
    $viatura->marca .
    ' ' .
    $viatura->modelo .
    ' disponível
    na UrbanMotors.')

@section('content')
    @php
        $matriculaMascarada = substr($viatura->matricula, 0, 2) . '-**-**';
    @endphp

    <section class="py-5 bg-light border-bottom">
        <div class="container breadcrum_nav">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb small mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="{{ route('catalogo.index') }}" class="text-decoration-none text-muted">Catálogo</a>
                    </li>

                    <li class="breadcrumb-item active fw-semibold" aria-current="page">
                        {{ $viatura->marca }} {{ $viatura->modelo }}
                    </li>
                </ol>
            </nav>

            <h1 class="display-4 fw-bold mb-3">
                {{ $viatura->marca }} {{ $viatura->modelo }}
            </h1>

            <p class="text-muted fs-6 mb-0">
                Informação detalhada sobre esta viatura atualmente disponível no catálogo.
            </p>
        </div>
    </section>

    <section class="pt-4 pb-3 bg-light border-bottom">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="public-detail-card overflow-hidden h-100">
                        @if ($viatura->imagem_url)
                            <img
                                src="{{ $viatura->imagem_url }}"
                                alt="{{ $viatura->marca }} {{ $viatura->modelo }}"
                                class="w-100"
                            >
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light h-100"
                                style="min-height: 500px;">
                                Sem imagem
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="public-detail-card h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="mb-3">
                                <span class="badge {{ $viatura->vendido ? 'bg-danger' : 'bg-success' }} fs-6 px-3 py-2 mb-3">
                                    {{ $viatura->vendido ? 'Vendida' : 'Disponível' }}
                                </span>

                                <h2 class="h3 fw-bold mb-1">
                                    {{ $viatura->marca }} {{ $viatura->modelo }}
                                </h2>

                                <div class="text-muted">
                                    {{ $viatura->ano }} · {{ number_format($viatura->quilometragem, 0, ',', '.') }} km
                                </div>
                            </div>

                            <div class="vehicle-price mb-4">
                                {{ number_format($viatura->preco, 2, ',', '.') }} €
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-6">
                                    <div class="public-spec-card">
                                        <small>Matrícula</small>
                                        <strong>{{ $matriculaMascarada }}</strong>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="public-spec-card">
                                        <small>Ano</small>
                                        <strong>{{ $viatura->ano }}</strong>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="public-spec-card">
                                        <small>Quilómetros</small>
                                        <strong>{{ number_format($viatura->quilometragem, 0, ',', '.') }} km</strong>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="public-spec-card">
                                        <small>Combustível</small>
                                        <strong>{{ $viatura->combustivel }}</strong>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="public-spec-card">
                                        <small>Cor</small>
                                        <strong>{{ $viatura->cor }}</strong>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="public-spec-card">
                                        <small>Estado</small>
                                        <strong>{{ $viatura->vendido ? 'Vendida' : 'Disponível' }}</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mt-auto">
                                <a href="{{ route('contactos.index') }}" class="btn btn-primary btn-lg">
                                    Pedir informações
                                </a>

                                <a href="{{ route('catalogo.index') }}" class="btn btn-outline-secondary">
                                    Voltar ao catálogo
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Descrição --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="public-info-card">
                        <div class="card-body">
                            <h2 class="h4 fw-bold mb-3">Descrição</h2>

                            @if (!empty($viatura->descricao))
                                <p class="text-muted mb-0" style="white-space: pre-line;">
                                    {{ $viatura->descricao }}
                                </p>
                            @else
                                <p class="text-muted mb-0">
                                    Não existe descrição adicional disponível para esta viatura neste momento.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Equipamento --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="public-info-card">
                        <div class="card-body">
                            <h2 class="h4 fw-bold mb-3">Equipamento</h2>

                            @if (!empty($viatura->equipamento))
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach (explode("\n", $viatura->equipamento) as $item)
                                        @if (trim($item) !== '')
                                            <span class="badge bg-light text-dark border px-3 py-2">
                                                ✓ {{ trim($item) }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mb-0">
                                    Informação sobre equipamento ainda não disponível.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informação Técnica --}}
            <div class="row mt-4">
                <div class="col-12">
                    <div class="public-info-card">
                        <div class="card-body">
                            <h2 class="h4 fw-bold mb-3">Informação Técnica</h2>

                            <div class="row g-3">
                                <div class="col-md-4 col-sm-6">
                                    <div class="public-spec-card h-100">
                                        <small>Marca</small>
                                        <strong>{{ $viatura->marca }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="public-spec-card h-100">
                                        <small>Modelo</small>
                                        <strong>{{ $viatura->modelo }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="public-spec-card h-100">
                                        <small>Ano</small>
                                        <strong>{{ $viatura->ano }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="public-spec-card h-100">
                                        <small>Combustível</small>
                                        <strong>{{ $viatura->combustivel }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="public-spec-card h-100">
                                        <small>Cor</small>
                                        <strong>{{ $viatura->cor }}</strong>
                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6">
                                    <div class="public-spec-card h-100">
                                        <small>Quilometragem</small>
                                        <strong>{{ number_format($viatura->quilometragem, 0, ',', '.') }} km</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Vantagens / Ajuda --}}
            <div class="row mt-4 g-4">
                <div class="col-lg-6">
                    <div class="public-info-card h-100">
                        <div class="card-body">
                            <h2 class="h5 fw-bold mb-3">Vantagens desta viatura</h2>

                            <ul class="mb-0 text-muted">
                                <li class="mb-2">
                                    Apenas {{ number_format($viatura->quilometragem, 0, ',', '.') }} km registados.
                                </li>
                                <li class="mb-2">
                                    Motor {{ strtolower($viatura->combustivel) }}, adequado para uma condução eficiente.
                                </li>
                                <li class="mb-2">
                                    Viatura disponível para contacto e pedido de informações.
                                </li>
                                <li class="mb-0">
                                    Excelente opção para quem procura um {{ $viatura->marca }} {{ $viatura->modelo }} com
                                    boa relação qualidade/preço.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="public-info-card h-100">
                        <div class="card-body d-flex flex-column">
                            <h2 class="h5 fw-bold mb-3">Precisa de ajuda?</h2>

                            <p class="text-muted">
                                Entre em contacto com a UrbanMotors para esclarecer dúvidas, confirmar disponibilidade
                                ou pedir mais informações sobre esta viatura.
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('contactos.index') }}" class="btn btn-outline-primary w-100">
                                    Ir para contactos
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Viaturas Semelhantes --}}
            @if ($relacionadas->count() > 0)
                @php
                    $sliderMd = $relacionadas->count() > 1;
                    $sliderLg = $relacionadas->count() > 2;
                @endphp

                <div class="row mt-5">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-end mb-3">
                            <div>
                                <h2 class="h4 fw-bold mb-1">Viaturas semelhantes</h2>
                                <p class="text-muted mb-0">
                                    Outras opções disponíveis que podem interessar.
                                </p>
                            </div>

                            <a href="{{ route('catalogo.index') }}" class="text-decoration-none fw-semibold">
                                Ver catálogo
                            </a>
                        </div>
                    </div>
                </div>

                <div
                    class="
                        related-vehicles
                        row g-4
                        {{ $sliderMd ? 'related-slider-mobile' : '' }}
                        {{ $sliderLg ? 'related-slider-tablet' : '' }}
                    "
                >
                    @foreach ($relacionadas as $relacionada)
                        <div class="related-vehicle-item col-xl-4 col-md-6">
                            <div class="card h-100 border-0 shadow-sm overflow-hidden rounded-4 related-card">
                                @if ($relacionada->imagem_url)
                                    <img
                                        src="{{ $relacionada->imagem_url }}"
                                        alt="{{ $relacionada->marca }} {{ $relacionada->modelo }}"
                                        class="card-img-top"
                                        style="height: 210px; object-fit: cover;"
                                    >
                                @else
                                    <div
                                        class="d-flex align-items-center justify-content-center bg-light text-muted"
                                        style="height: 210px;"
                                    >
                                        Sem imagem
                                    </div>
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                        <h3 class="h5 fw-bold mb-0">
                                            {{ $relacionada->marca }} {{ $relacionada->modelo }}
                                        </h3>

                                        <span class="badge bg-success">
                                            Disponível
                                        </span>
                                    </div>

                                    <p class="text-muted mb-2">
                                        {{ $relacionada->ano }} · {{ number_format($relacionada->quilometragem, 0, ',', '.') }} km
                                    </p>

                                    <p class="text-muted mb-3">
                                        {{ $relacionada->combustivel }} · {{ $relacionada->cor }}
                                    </p>

                                    <div class="vehicle-price h4 mb-3">
                                        {{ number_format($relacionada->preco, 2, ',', '.') }} €
                                    </div>

                                    <a
                                        href="{{ route('catalogo.show', $relacionada) }}"
                                        class="btn btn-primary w-100 mt-auto"
                                    >
                                        Ver detalhes
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
