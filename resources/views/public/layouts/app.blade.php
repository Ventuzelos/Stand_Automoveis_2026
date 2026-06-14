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
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
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

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarPublica"
                    aria-controls="navbarPublica" aria-expanded="false" aria-label="Abrir navegação">
                    <span class="navbar-toggler-icon"></span>
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
                        <li class="nav-item ms-lg-2">
                            <a class="btn btn-primary" href="{{ route('login') }}">
                                Entrar
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row g-3 align-items-center">
                <div class="col-md-6">
                    <h2 class="h6 mb-1 fw-bold">UrbanMotors</h2>
                    <p class="mb-0 text-white-50">
                        Gestão e catálogo de viaturas com uma experiência simples e profissional.
                    </p>
                </div>

                <div class="col-md-6 text-md-end">
                    <small class="text-white-50">
                        &copy; {{ date('Y') }} UrbanMotors. Todos os direitos reservados.
                    </small>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
