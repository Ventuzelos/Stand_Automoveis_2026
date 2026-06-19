<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'UrbanMotors')</title>
    <meta name="description" content="@yield('metaDescription', 'Plataforma de gestão e catálogo de viaturas UrbanMotors.')">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/custom.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="preload" as="image" href="{{ asset('images/hero-car.webp') }}">
</head>

<body class="bg-light text-dark">
    <header class="border-bottom bg-white sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                    <div class="d-flex gap-2 align-items-center">
                        <img src="{{ asset('favicon.png') }}" alt="Logo" class="app-navbar-logo" width="45"
                            height="45">
                        UrbanMotors

                    </div>
                </a>

                <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarPublica" aria-controls="navbarPublica" aria-expanded="false"
                    aria-label="Abrir navegação">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarPublica">
                    <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}"
                                href="{{ route('home') }}">
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('catalogo.*') ? 'active fw-semibold' : '' }}"
                                href="{{ route('catalogo.index') }}">
                                Catálogo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('contactos.*') ? 'active fw-semibold' : '' }}"
                                href="{{ route('contactos.index') }}">
                                Contactos
                            </a>
                        </li>
                        @guest
                            <li class="nav-item ms-lg-2">
                                <a class="btn btn-primary" href="{{ route('login') }}">
                                    Entrar
                                </a>
                            </li>
                        @endguest

                        @auth
                            <li class="nav-item ms-lg-2">
                                <a class="btn btn-primary" href="{{ route('dashboard') }}">
                                    Dashboard
                                </a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="public-footer">
        <div class="container">
            <div class="row g-4 align-items-start">
                <div class="col-lg-5">
                    <div class="footer-brand mb-2">
                        UrbanMotors
                    </div>

                    <p class="footer-text mb-0">
                        Gestão e catálogo de viaturas com uma experiência simples, profissional e transparente.
                    </p>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <h3 class="footer-title">Links rápidos</h3>

                    <ul class="footer-links">
                        <li>
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('catalogo.index') }}">Catálogo</a>
                        </li>
                        <li>
                            <a href="{{ route('contactos.index') }}">Contactos</a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6 col-lg-4">
                    <h3 class="footer-title">Contactos</h3>

                    <ul class="footer-links">
                        <li>
                            <span>Email:</span> geral@urbanmotors.pt
                        </li>
                        <li>
                            <span>Telefone:</span> +351 912 345 678
                        </li>
                        <li>
                            <span>Horário:</span> Seg. a Sex. · 09h00 - 18h00
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <span>© 2026 UrbanMotors. Todos os direitos reservados.</span>
                <span>Stand Automóveis</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggler = document.querySelector('.custom-toggler');
        const navbar = document.querySelector('#navbarPublica');

        navbar.addEventListener('show.bs.collapse', () => {
            toggler.classList.add('is-open');
            document.body.style.overflow = 'hidden';
        });

        navbar.addEventListener('hide.bs.collapse', () => {
            toggler.classList.remove('is-open');
            document.body.style.overflow = '';
        });
    </script>
</body>

</html>
