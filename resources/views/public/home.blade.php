@extends('public.layouts.app')

@section('title', 'UrbanMotors - Home')
@section('metaDescription', 'Consulte viaturas disponíveis, estatísticas e destaques recentes da UrbanMotors.')

@section('content')
    <section class="hero-section" style="background-image:
    linear-gradient(
        90deg,
        rgba(15,23,42,.82),
        rgba(15,23,42,.25)
    ),
    url('{{ asset('images/hero-car.png') }}')">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge bg-primary-subtle text-primary mb-3 px-3 py-2">
                        Viaturas disponíveis com gestão profissional
                    </span>

                    <h1 class="hero-title">
                        Encontre a sua próxima viatura com confiança.
                    </h1>

                    <p class="hero-subtitle">
                        Explore o catálogo da UrbanMotors, compare opções disponíveis e encontre a solução certa
                        com informação clara, preço visível e contacto direto.
                    </p>

                    <div class="d-flex flex-wrap gap-3 mb-4">
                        <a href="{{ route('catalogo.index') }}" class="btn btn-primary btn-lg">
                            Ver catálogo
                        </a>
                        <a href="{{ route('contactos.index') }}" class="btn btn-outline-light btn-lg">
                            Pedir informações
                        </a>
                    </div>

                    <div class="hero-search-card">
                        <form action="{{ route('catalogo.index') }}" method="GET">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label for="marca" class="form-label">Marca</label>
                                    <input type="text" name="marca" id="marca" class="form-control" placeholder="Ex: BMW">
                                </div>

                                <div class="col-md-4">
                                    <label for="modelo" class="form-label">Modelo</label>
                                    <input type="text" name="modelo" id="modelo" class="form-control" placeholder="Ex: Série 3">
                                </div>

                                <div class="col-md-4">
                                    <label for="preco_max" class="form-label">Preço máximo</label>
                                    <input type="number" name="preco_max" id="preco_max" class="form-control" placeholder="Ex: 25000">
                                </div>

                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-4">
                                        Pesquisar viaturas
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-label">Viaturas disponíveis</div>
                        <div class="stat-value">{{ $totalDisponiveis }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-label">Marcas disponíveis</div>
                        <div class="stat-value">{{ $totalMarcas }}</div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-label">Catálogo online</div>
                        <div class="stat-value">24/7</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
                <div>
                    <h2 class="section-title mb-2">Viaturas em destaque</h2>
                    <p class="section-text mb-0">
                        Veja algumas das viaturas mais recentes atualmente disponíveis no catálogo.
                    </p>
                </div>

                <a href="{{ route('catalogo.index') }}" class="btn btn-outline-primary">
                    Ver todas
                </a>
            </div>

            <div class="row g-4">
                @forelse ($viaturasRecentes as $viatura)
                    <div class="col-md-6 col-xl-4">
                        <div class="vehicle-card h-100">
                            @if ($viatura->imagem)
                                <img src="{{ asset('storage/' . $viatura->imagem) }}"
                                     alt="{{ $viatura->marca }} {{ $viatura->modelo }}"
                                     class="vehicle-image">
                            @else
                                <div class="vehicle-image d-flex align-items-center justify-content-center text-muted">
                                    Sem imagem
                                </div>
                            @endif

                            <div class="p-4 d-flex flex-column h-100">
                                <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                                    <div>
                                        <h3 class="h5 fw-bold mb-1">
                                            {{ $viatura->marca }} {{ $viatura->modelo }}
                                        </h3>
                                        <div class="vehicle-meta">
                                            {{ $viatura->ano }} · {{ number_format($viatura->quilometragem, 0, ',', '.') }} km
                                        </div>
                                    </div>

                                    <span class="badge bg-success">Disponível</span>
                                </div>

                                <div class="vehicle-meta mb-3">
                                    {{ $viatura->combustivel }} · {{ $viatura->cor }}
                                </div>

                                <div class="vehicle-price mb-4">
                                    {{ number_format($viatura->preco, 2, ',', '.') }} €
                                </div>

                                <div class="mt-auto">
                                    <a href="{{ route('catalogo.show', $viatura->id) }}" class="btn btn-primary w-100">
                                        Ver detalhes
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-secondary mb-0">
                            Neste momento não existem viaturas disponíveis para mostrar.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <h3>Processo simples</h3>
                        <p>Consulte as viaturas, compare dados principais e entre em contacto de forma rápida.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <h3>Informação transparente</h3>
                        <p>Preço, quilometragem, ano, combustível e estado apresentados de forma objetiva.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <h3>Apoio comercial</h3>
                        <p>Uma base sólida para futura integração com pedidos de contacto e intermediação de crédito.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="cta-section">
                <div class="row align-items-center g-4">
                    <div class="col-lg-8">
                        <h2 class="section-title mb-2">Quer explorar todas as opções disponíveis?</h2>
                        <p class="section-text mb-0">
                            Use o catálogo para consultar viaturas, aplicar filtros e encontrar o modelo mais adequado.
                        </p>
                    </div>

                    <div class="col-lg-4 text-lg-end">
                        <a href="{{ route('catalogo.index') }}" class="btn btn-light btn-lg">
                            Abrir catálogo
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
