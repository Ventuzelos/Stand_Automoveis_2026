@extends('public.layouts.app')

@section('title', 'UrbanMotors - Sobre Nós')
@section('metaDescription',
    'Conheça a UrbanMotors e a nossa missão de proporcionar uma experiência automóvel
    transparente e de confiança.')

@section('content')
    <section class="contact-hero">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="section-kicker">Sobre Nós</span>

                    <h1 class="section-title mb-3">
                        A sua confiança sobre rodas.
                    </h1>

                    <p class="section-text mb-0">
                        A UrbanMotors é uma plataforma dedicada à comercialização de viaturas seminovas e usadas,
                        focada em proporcionar uma experiência simples, transparente e segura.
                    </p>
                </div>

                <div class="col-lg-4">
                    <div class="contact-hero-card">
                        <i class="bi bi-car-front"></i>
                        <div>
                            <strong>Garantia</strong>
                            <span>Viaturas selecionadas com rigor</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            <div class=" mb-5">
                <h2 class="h3 fw-bold mb-3">Quem Somos</h2>

                <p class="text-muted">
                    A UrbanMotors nasceu com o objetivo de modernizar a forma como os clientes
                    procuram e compram automóveis.
                </p>

                <p class="text-muted">
                    Apostamos na transparência, qualidade do serviço e proximidade com os clientes,
                    garantindo informação clara sobre cada viatura disponível.
                </p>
            </div>
            <div class=" mb-5">
                <h3 class="h5 fw-bold mb-3">A nossa missão</h3>
                <p class="text-muted mb-0">
                    Facilitar a procura da viatura ideal através de um catálogo organizado,
                    informação detalhada e um acompanhamento profissional durante todo o processo.
                </p>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="contact-mini-card">
                        <div class="card-body p-4">
                            <div class="contact-mini-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>

                            <h3 class="h6 fw-bold mb-2">Confiança</h3>

                            <p class="text-muted mb-0">
                                Informação transparente e acompanhamento próximo.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-mini-card">
                        <div class="card-body p-4">
                            <div class="contact-mini-icon">
                                <i class="bi bi-award"></i>
                            </div>

                            <h3 class="h6 fw-bold mb-2">Qualidade</h3>

                            <p class="text-muted mb-0">
                                Viaturas cuidadosamente selecionadas para garantir fiabilidade.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-mini-card">
                        <div class="card-body p-4">
                            <div class="contact-mini-icon">
                                <i class="bi bi-people"></i>
                            </div>

                            <h3 class="h6 fw-bold mb-2">Proximidade</h3>

                            <p class="text-muted mb-0">
                                Atendimento personalizado e foco total na satisfação do cliente.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="contact-form-card">
                <div class="card-body p-4 p-lg-5 text-center">
                    <span class="section-kicker">UrbanMotors</span>

                    <h2 class="h3 fw-bold mb-3">
                        Prontos para encontrar a sua próxima viatura?
                    </h2>

                    <p class="section-text mb-4" style="margin: auto">
                        Explore o nosso catálogo e descubra as oportunidades disponíveis.
                    </p>

                    <a href="{{ route('catalogo.index') }}" class="btn btn-primary">
                        Ver Catálogo
                    </a>
                </div>
            </div>

        </div>
    </section>


@endsection
