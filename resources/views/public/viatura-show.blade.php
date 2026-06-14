@extends('public.layouts.app')

@section('title', $viatura->marca . ' ' . $viatura->modelo . ' - UrbanMotors')
@section('metaDescription', 'Consulte os detalhes da viatura ' . $viatura->marca . ' ' . $viatura->modelo . ' disponível na UrbanMotors.')

@section('content')
    @php
        $matriculaMascarada = substr($viatura->matricula, 0, 2) . '-**-**';
    @endphp

    <section class="py-4 bg-light border-bottom">
        <div class="container">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}" class="text-decoration-none">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('catalogo.index') }}" class="text-decoration-none">Catálogo</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $viatura->marca }} {{ $viatura->modelo }}
                    </li>
                </ol>
            </nav>

            <h1 class="section-title mb-2">{{ $viatura->marca }} {{ $viatura->modelo }}</h1>
            <p class="section-text mb-0">
                Informação detalhada sobre esta viatura atualmente disponível no catálogo.
            </p>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-7">
                    <div class="public-detail-card overflow-hidden h-100">
                        @if ($viatura->imagem)
                            <img src="{{ asset('storage/' . $viatura->imagem) }}"
                                 alt="{{ $viatura->marca }} {{ $viatura->modelo }}"
                                 class="img-fluid w-100 vehicle-image"
                                 style="height: 480px;">
                        @else
                            <div class="vehicle-image d-flex align-items-center justify-content-center text-muted" style="height: 480px;">
                                Sem imagem disponível
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="public-detail-card h-100">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                <div>
                                    <span class="badge bg-success mb-2">Disponível</span>
                                    <h2 class="h3 fw-bold mb-1">
                                        {{ $viatura->marca }} {{ $viatura->modelo }}
                                    </h2>
                                    <div class="text-muted">
                                        {{ $viatura->ano }} · {{ number_format($viatura->quilometragem, 0, ',', '.') }} km
                                    </div>
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

            <div class="row mt-4 g-4">
                <div class="col-lg-6">
                    <div class="public-info-card">
                        <div class="card-body">
                            <h2 class="h5 fw-bold mb-3">Porque escolher esta viatura</h2>
                            <ul class="mb-0 text-muted">
                                <li class="mb-2">Informação clara e organizada sobre o veículo.</li>
                                <li class="mb-2">Consulta simples da quilometragem, preço e características principais.</li>
                                <li class="mb-0">Pedido de contacto rápido através da área pública.</li>
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
        </div>
    </section>
@endsection
