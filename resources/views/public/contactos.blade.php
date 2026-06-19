@extends('public.layouts.app')

@section('title', 'UrbanMotors - Contactos')
@section('metaDescription', 'Entre em contacto com a UrbanMotors para pedir informações sobre viaturas disponíveis.')

@section('content')
    <section class="contact-hero">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-8">
                    <span class="section-kicker">Contactos</span>

                    <h1 class="section-title mb-3">
                        Estamos disponíveis para o ajudar.
                    </h1>

                    <p class="section-text mb-0">
                        Entre em contacto para informações sobre viaturas, disponibilidade,
                        financiamento ou apoio comercial.
                    </p>
                </div>

                <div class="col-lg-4">
                    <div class="contact-hero-card">
                        <i class="bi bi-headset"></i>
                        <div>
                            <strong>Apoio comercial</strong>
                            <span>Resposta rápida e personalizada</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <strong>Pedido enviado com sucesso.</strong>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                </div>
            @endif

            <div class="row g-4 align-items-stretch">
                <div class="col-lg-4">
                    <div class="contact-info-card h-100">
                        <div class="card-body p-4">
                            <h2 class="h5 fw-bold mb-4">Informações de contacto</h2>

                            <div class="contact-info-list">
                                <div class="contact-info-item">
                                    <div class="contact-info-icon">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <div>
                                        <span>Morada</span>
                                        <strong>Rua do Automóvel, 125
                                            <br>4700-000 Braga
                                            <br>Portugal</strong>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-icon">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div>
                                        <span>Telefone</span>
                                        <strong>+351 253 000 000</strong>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div>
                                        <span>Email</span>
                                        <strong>geral@urbanmotors.pt</strong>
                                    </div>
                                </div>

                                <div class="contact-info-item">
                                    <div class="contact-info-icon">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                    <div>
                                        <span>Horário</span>
                                        <strong>Seg. a Sáb. · 09:00 às 19:00</strong>
                                    </div>
                                </div>
                            </div>

                            <div class="contact-map mt-4">
                                <iframe src="https://www.google.com/maps?q=Braga,Portugal&output=embed" width="100%"
                                    height="230" style="border:0;" loading="lazy"
                                    referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="contact-form-card h-100">
                        <div class="card-body p-4 p-lg-5">
                            <div class="mb-4">
                                <span class="section-kicker">Pedido de contacto</span>
                                <h2 class="h4 fw-bold mb-2">Enviar mensagem</h2>
                                <p class="section-text mb-0">
                                    Preencha o formulário e entraremos em contacto assim que possível.
                                </p>
                            </div>

                            <form action="{{ route('contactos.store') }}" method="POST" novalidate>
                                @csrf

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" name="nome" id="nome"
                                            class="form-control @error('nome') is-invalid @enderror"
                                            value="{{ old('nome') }}" placeholder="O seu nome">

                                        @error('nome')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" placeholder="nome@email.com">

                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="text" name="telefone" id="telefone"
                                            class="form-control @error('telefone') is-invalid @enderror"
                                            value="{{ old('telefone') }}" placeholder="+351 ...">

                                        @error('telefone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="assunto" class="form-label">Assunto</label>
                                        <input type="text" name="assunto" id="assunto"
                                            class="form-control @error('assunto') is-invalid @enderror"
                                            value="{{ old('assunto') }}" placeholder="Ex: Pedido de informações">

                                        @error('assunto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="mensagem" class="form-label">Mensagem</label>
                                        <textarea name="mensagem" id="mensagem" rows="6" class="form-control @error('mensagem') is-invalid @enderror"
                                            placeholder="Escreva a sua mensagem...">{{ old('mensagem') }}</textarea>

                                        @error('mensagem')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 d-flex flex-wrap gap-2 pt-2">
                                        <button type="submit" class="btn btn-primary px-4">
                                            <i class="bi bi-send me-1"></i>
                                            Enviar mensagem
                                        </button>

                                        <a href="{{ route('catalogo.index') }}" class="btn btn-outline-secondary">
                                            Ver catálogo
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4 mt-1">
                <div class="col-md-4">
                    <div class="contact-mini-card">
                        <div class="card-body p-4">
                            <div class="contact-mini-icon">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <h2 class="h6 fw-bold mb-2">Atendimento comercial</h2>
                            <p class="text-muted mb-0">
                                Esclarecemos dúvidas sobre preço, disponibilidade e características das viaturas.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-mini-card">
                        <div class="card-body p-4">
                            <div class="contact-mini-icon">
                                <i class="bi bi-lightning-charge"></i>
                            </div>
                            <h2 class="h6 fw-bold mb-2">Resposta rápida</h2>
                            <p class="text-muted mb-0">
                                Utilize o formulário para um contacto direto e organizado com a equipa.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-mini-card">
                        <div class="card-body p-4">
                            <div class="contact-mini-icon">
                                <i class="bi bi-person-check"></i>
                            </div>
                            <h2 class="h6 fw-bold mb-2">Apoio personalizado</h2>
                            <p class="text-muted mb-0">
                                Ajudamos a encontrar a viatura mais adequada às suas necessidades.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
