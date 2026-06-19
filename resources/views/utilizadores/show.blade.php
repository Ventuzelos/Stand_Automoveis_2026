<x-app-layout>
    <x-slot name="header">
        <div>
            <x-breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Utilizadores', 'url' => route('utilizadores.index')],
                ['label' => $utilizador->name],
            ]" />
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="dashboard-kicker">Administração</span>
                <h2 class="fs-4 fw-bold mb-0">{{ $utilizador->name }}</h2>
                <p class="text-muted mb-0">
                    Informação detalhada da conta e permissões do utilizador.
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('utilizadores.index') }}" class="btn btn-outline-secondary">
                    Voltar
                </a>

                <a href="{{ route('utilizadores.edit', $utilizador->id) }}" class="btn btn-primary">
                    Editar Utilizador
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="dashboard-card h-100">
                    <div class="text-center">
                        <div class="client-avatar mx-auto mb-3">
                            {{ strtoupper(substr($utilizador->name, 0, 1)) }}
                        </div>

                        <h3 class="h4 fw-bold mb-1">
                            {{ $utilizador->name }}
                        </h3>

                        <p class="text-muted mb-3">
                            {{ $utilizador->email }}
                        </p>

                        @if ($utilizador->role === 'admin')
                            <span class="badge bg-dark px-3 py-2">
                                Administrador
                            </span>
                        @else
                            <span class="badge bg-secondary px-3 py-2">
                                Vendedor
                            </span>
                        @endif
                    </div>

                    <hr class="my-4">

                    <div class="client-contact-list">
                        <div class="client-contact-item">
                            <span>Email</span>
                            <strong>{{ $utilizador->email }}</strong>
                        </div>

                        <div class="client-contact-item">
                            <span>Role</span>
                            <strong>
                                {{ $utilizador->role === 'admin' ? 'Administrador' : 'Vendedor' }}
                            </strong>
                        </div>

                        <div class="client-contact-item">
                            <span>Email verificado</span>
                            <strong>
                                {{ $utilizador->email_verified_at ? 'Sim' : 'Não' }}
                            </strong>
                        </div>
                    </div>

                    @if (auth()->id() !== $utilizador->id)
                        <form action="{{ route('utilizadores.destroy', $utilizador->id) }}"
                            method="POST"
                            class="mt-4">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                class="btn btn-outline-danger w-100"
                                onclick="return confirm('Tens a certeza que queres eliminar este utilizador?')">
                                Eliminar Utilizador
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <div class="col-lg-8">
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="dashboard-card dashboard-stat-card h-100">
                            <span class="dashboard-label">
                                ID Utilizador
                            </span>

                            <h3>{{ $utilizador->id }}</h3>

                            <small class="dashboard-meta">
                                Identificador interno
                            </small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-card dashboard-stat-card h-100">
                            <span class="dashboard-label">
                                Estado Email
                            </span>

                            <h3>
                                {{ $utilizador->email_verified_at ? 'Verificado' : 'Pendente' }}
                            </h3>

                            <small class="dashboard-meta">
                                Confirmação de conta
                            </small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="dashboard-card dashboard-stat-card h-100">
                            <span class="dashboard-label">
                                Perfil
                            </span>

                            <h3>
                                {{ $utilizador->role === 'admin' ? 'Admin' : 'Vendedor' }}
                            </h3>

                            <small class="dashboard-meta">
                                Permissões atribuídas
                            </small>
                        </div>
                    </div>
                </div>

                <div class="dashboard-panel">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">
                                Informação da Conta
                            </h4>

                            <p class="dashboard-panel-subtitle">
                                Dados técnicos e histórico do utilizador.
                            </p>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="client-contact-item">
                                <span>Nome</span>
                                <strong>{{ $utilizador->name }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="client-contact-item">
                                <span>Email</span>
                                <strong>{{ $utilizador->email }}</strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="client-contact-item">
                                <span>Criado em</span>
                                <strong>
                                    {{ $utilizador->created_at?->format('d/m/Y H:i') }}
                                </strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="client-contact-item">
                                <span>Última atualização</span>
                                <strong>
                                    {{ $utilizador->updated_at?->format('d/m/Y H:i') }}
                                </strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="client-contact-item">
                                <span>Email verificado</span>
                                <strong>
                                    {{ $utilizador->email_verified_at ? 'Sim' : 'Não' }}
                                </strong>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="client-contact-item">
                                <span>Role</span>
                                <strong>
                                    {{ $utilizador->role === 'admin' ? 'Administrador' : 'Vendedor' }}
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
