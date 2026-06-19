<x-app-layout>
    <x-slot name="header">
        <div>
            <x-breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Perfil']
            ]" />
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="dashboard-kicker">Conta</span>
                <h2 class="fs-4 fw-bold mb-0">Perfil do Utilizador</h2>
                <p class="text-muted mb-0">
                    Gere os seus dados pessoais, email, password e definições da conta.
                </p>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="dashboard-card h-100">
                    <div class="text-center">
                        <div class="client-avatar mx-auto mb-3">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <h3 class="h4 fw-bold mb-1">
                            {{ auth()->user()->name }}
                        </h3>

                        <p class="text-muted mb-3">
                            {{ auth()->user()->email }}
                        </p>

                        @if (auth()->user()->role === 'admin')
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
                            <strong>{{ auth()->user()->email }}</strong>
                        </div>

                        <div class="client-contact-item">
                            <span>Role</span>
                            <strong>
                                {{ auth()->user()->role === 'admin' ? 'Administrador' : 'Vendedor' }}
                            </strong>
                        </div>

                        <div class="client-contact-item">
                            <span>Email verificado</span>
                            <strong>
                                {{ auth()->user()->email_verified_at ? 'Sim' : 'Não' }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="dashboard-panel mb-4">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">
                                Informação do Perfil
                            </h4>
                            <p class="dashboard-panel-subtitle">
                                Atualiza o nome e o endereço de email da conta.
                            </p>
                        </div>
                    </div>

                    <div class="profile-form-wrapper">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="dashboard-panel mb-4">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">
                                Alterar Password
                            </h4>
                            <p class="dashboard-panel-subtitle">
                                Usa uma password longa e segura para proteger a conta.
                            </p>
                        </div>
                    </div>

                    <div class="profile-form-wrapper">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="dashboard-panel border-danger-subtle">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title text-danger">
                                Eliminar Conta
                            </h4>
                            <p class="dashboard-panel-subtitle">
                                A eliminação da conta é permanente e não pode ser revertida.
                            </p>
                        </div>
                    </div>

                    <div class="profile-form-wrapper">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
