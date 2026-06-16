@extends('public.layouts.app')

@section('title', 'UrbanMotors - Home')
@section('metaDescription', 'Consulte viaturas disponíveis, estatísticas e destaques recentes da UrbanMotors.')

@section('content')
    <section class="hero-section"
        style="background-image:
    linear-gradient(
        90deg,
        rgba(15,23,42,.82),
        rgba(15,23,42,.25)
    ),
    url('{{ asset('images/hero-car.webp') }}')">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-7">
                    <span class="badge badge-orange mb-3 px-3 py-2">
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
                                    <input type="text" name="marca" id="marca" class="form-control"
                                        placeholder="Ex: BMW">
                                </div>

                                <div class="col-md-4">
                                    <label for="modelo" class="form-label">Modelo</label>
                                    <input type="text" name="modelo" id="modelo" class="form-control"
                                        placeholder="Ex: Série 3">
                                </div>

                                <div class="col-md-4">
                                    <label for="preco_max" class="form-label">Preço máximo</label>
                                    <input type="number" name="preco_max" id="preco_max" class="form-control"
                                        placeholder="Ex: 25000">
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
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="bi bi-car-front"></i>
                        </div>

                        <div>
                            <div class="stat-label">Viaturas disponíveis</div>
                            <div class="stat-value js-countup" data-count="{{ $totalDisponiveis }}">0</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>

                        <div>
                            <div class="stat-label">Vendas realizadas</div>
                            <div class="stat-value js-countup" data-count="{{ $totalVendas }}">0</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card d-flex align-items-center gap-3">
                        <div class="stat-icon">
                            <i class="bi bi-people"></i>
                        </div>

                        <div>
                            <div class="stat-label">Clientes registados</div>
                            <div class="stat-value js-countup" data-count="{{ $totalClientes }}">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="brand-strip">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <h2 class="h5 fw-bold mb-1">Marcas em destaque</h2>
                        <p class="text-muted mb-0">
                            Conheça algumas das marcas disponíveis no catálogo UrbanMotors.
                        </p>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($marcasDisponiveis as $marca)
                            <a href="{{ route('catalogo.index', ['marca' => $marca]) }}" class="brand-pill">
                                {{ $marca }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pb-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
                <div>
                    <h2 class="section-title mb-2">Viaturas recentemente adicionadas</h2>
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
                            @if ($viatura->imagem_url)
                                <img src="{{ $viatura->imagem_url }}" alt="{{ $viatura->marca }} {{ $viatura->modelo }}">
                            @else
                                <div>Sem imagem</div>
                            @endif

                            <div class="p-4 d-flex flex-column h-100">
                                <div class="d-flex justify-content-between align-items-start gap-3 mb-2">
                                    <div>
                                        <h3 class="h5 fw-bold mb-1">
                                            {{ $viatura->marca }} {{ $viatura->modelo }}
                                        </h3>
                                        <div class="vehicle-meta">
                                            {{ $viatura->ano }} ·
                                            {{ number_format($viatura->quilometragem, 0, ',', '.') }} km
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column align-items-end gap-1">
                                        @if ($viatura->created_at && $viatura->created_at->gt(now()->subDays(15)))
                                            <span class="badge bg-primary">
                                                Novo
                                            </span>
                                        @endif

                                        <span class="badge bg-success">
                                            Disponível
                                        </span>
                                    </div>
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

    <section class="home-section-spaced">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title mb-2">
                    O que dizem os nossos clientes
                </h2>

                <p class="section-text mx-auto">
                    A confiança dos nossos clientes é o nosso maior compromisso.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <div class="testimonial-stars mb-3">
                            ★★★★★
                        </div>

                        <p class="testimonial-text">
                            "Processo simples, transparente e rápido. Encontrei exatamente a viatura que procurava."
                        </p>

                        <div class="testimonial-author">
                            João Silva
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <div class="testimonial-stars mb-3">
                            ★★★★★
                        </div>

                        <p class="testimonial-text">
                            "Excelente experiência e informação muito clara durante todo o processo."
                        </p>

                        <div class="testimonial-author">
                            Ana Costa
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="testimonial-card h-100">
                        <div class="testimonial-stars mb-3">
                            ★★★★★
                        </div>

                        <p class="testimonial-text">
                            "Catálogo organizado, viaturas bem apresentadas e atendimento profissional."
                        </p>

                        <div class="testimonial-author">
                            Pedro Martins
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-section-spaced">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title mb-2">
                    Porque escolher a UrbanMotors
                </h2>

                <p class="section-text mx-auto">
                    Uma experiência transparente, profissional e focada em ajudar a encontrar a viatura certa.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-xl-3">
                    <div class="feature-card text-center h-100">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-shield-check"></i>
                        </div>

                        <h3>Viaturas verificadas</h3>

                        <p>
                            Todas as viaturas são apresentadas com informação clara e organizada.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="feature-card text-center h-100">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-clipboard-data"></i>
                        </div>

                        <h3>Informação transparente</h3>

                        <p>
                            Preço, quilometragem, ano e combustível apresentados sem complicações.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="feature-card text-center h-100">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-car-front"></i>
                        </div>

                        <h3>Catálogo atualizado</h3>

                        <p>
                            Consulte as viaturas mais recentes disponíveis em qualquer momento.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-xl-3">
                    <div class="feature-card text-center h-100">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-headset"></i>
                        </div>

                        <h3>Apoio comercial</h3>

                        <p>
                            Contacte-nos facilmente para esclarecer dúvidas ou pedir informações.
                        </p>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.js-countup');

            counters.forEach(counter => {
                const target = parseInt(counter.dataset.count);
                const duration = 1500;
                const steps = 100;
                const increment = target / steps;

                let current = 0;

                const timer = setInterval(() => {
                    current += increment;

                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, duration / steps);
            });
        });
    </script>
@endsection
