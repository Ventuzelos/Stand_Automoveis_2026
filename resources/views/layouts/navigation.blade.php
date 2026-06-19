
<nav class="app-navbar"
    x-data="{ open: false }"
    :class="{ 'menu-open': open }"
    x-effect="document.body.style.overflow = open ? 'hidden' : ''">

    <div class="container">
        <div class="app-navbar-row">

            <!-- Logo -->
            <div class="d-flex gap-2 align-items-center">
                <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                    <div class="d-flex gap-2 align-items-center">
                        <img src="{{ asset('favicon.png') }}"
                            alt="Logo"
                            class="app-navbar-logo"
                            width="45"
                            height="45">

                        UrbanMotors
                    </div>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="app-navbar-links desktop-only">
                <a href="{{ route('dashboard') }}"
                    class="app-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('clientes.index') }}"
                    class="app-nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    Clientes
                </a>

                <a href="{{ route('viaturas.index') }}"
                    class="app-nav-link {{ request()->routeIs('viaturas.*') ? 'active' : '' }}">
                    Viaturas
                </a>

                <a href="{{ route('vendas.index') }}"
                    class="app-nav-link {{ request()->routeIs('vendas.*') ? 'active' : '' }}">
                    Vendas
                </a>

                <a href="{{ route('auditoria.index') }}"
                    class="app-nav-link {{ request()->routeIs('auditoria.*') ? 'active' : '' }}">
                    Auditoria
                </a>

                @can('gerir-utilizadores')
                    <a href="{{ route('utilizadores.index') }}"
                        class="app-nav-link {{ request()->routeIs('utilizadores.*') ? 'active' : '' }}">
                        Utilizadores
                    </a>
                @endcan
            </div>

            <!-- Desktop User -->
            <div class="app-navbar-user desktop-only">
                <a href="{{ route('profile.edit') }}" class="app-user-link">
                    {{ Auth::user()->name }}
                </a>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf

                    <button type="submit" class="app-logout-btn">
                        Sair
                    </button>
                </form>
            </div>

            <!-- Mobile Toggle -->
            <button type="button"
                class="app-mobile-toggle mobile-only"
                @click="open = !open"
                :aria-expanded="open.toString()"
                aria-label="Abrir menu">

                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="app-mobile-menu" :class="{ 'is-open': open }">

            <div class="app-mobile-links">

                <a href="{{ route('dashboard') }}"
                    class="app-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('clientes.index') }}"
                    class="app-nav-link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                    Clientes
                </a>

                <a href="{{ route('viaturas.index') }}"
                    class="app-nav-link {{ request()->routeIs('viaturas.*') ? 'active' : '' }}">
                    Viaturas
                </a>

                <a href="{{ route('vendas.index') }}"
                    class="app-nav-link {{ request()->routeIs('vendas.*') ? 'active' : '' }}">
                    Vendas
                </a>

                <a href="{{ route('auditoria.index') }}"
                    class="app-nav-link {{ request()->routeIs('auditoria.*') ? 'active' : '' }}">
                    Auditoria
                </a>

                @can('gerir-utilizadores')
                    <a href="{{ route('utilizadores.index') }}"
                        class="app-nav-link {{ request()->routeIs('utilizadores.*') ? 'active' : '' }}">
                        Utilizadores
                    </a>
                @endcan

            </div>

            <div class="app-mobile-user">

                <a href="{{ route('profile.edit') }}"
                    class="app-user-link app-user-link-mobile">
                    {{ Auth::user()->name }}
                </a>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf

                    <button type="submit"
                        class="app-logout-btn app-logout-btn-mobile">
                        Sair
                    </button>
                </form>

            </div>
        </div>
    </div>
</nav>

