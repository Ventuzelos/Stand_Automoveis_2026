<nav class="app-navbar" x-data="{ open: false }">
    <div class="container">
        <div class="app-navbar-row">
            <div class="d-flex gap-2 align-items-center">
                <img src="{{ asset('favicon.png') }}" alt="Logo" class="app-navbar-logo" width="45" height="45">
                <div class="app-navbar-brand" style="pointer-events: none;">
                    UrbanMotors
                </div>
            </div>

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
            </div>

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

            <button type="button" class="app-mobile-toggle mobile-only" @click="open = !open" :aria-expanded="open.toString()">
                <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>

                <svg x-show="open" x-cloak xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="app-mobile-menu mobile-only" x-show="open" x-transition x-cloak>
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
            </div>

            <div class="app-mobile-user">
                <a href="{{ route('profile.edit') }}" class="app-user-link app-user-link-mobile">
                    {{ Auth::user()->name }}
                </a>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="app-logout-btn app-logout-btn-mobile">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
