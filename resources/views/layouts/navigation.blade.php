<nav class="app-navbar">
    <div class="container">
        <div class="app-navbar-row">
            <div class="d-flex gap-2 align-items-center">
                <img src="{{ asset('favicon.png') }}" alt="Logo" class="app-navbar-logo" width="45" height="45">
                <div class="app-navbar-brand" style="pointer-events: none;">
                    UrbanMotors
                </div>
            </div>


            <div class="app-navbar-links">
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

            <div class="app-navbar-user">
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
        </div>
    </div>
</nav>
