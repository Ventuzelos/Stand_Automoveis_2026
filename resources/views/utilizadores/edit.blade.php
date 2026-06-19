<x-app-layout>
    <x-slot name="header">
        <div>
            <x-breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Utilizadores', 'url' => route('utilizadores.index')],
                ['label' => 'Editar ' . $utilizador->name],
            ]" />
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="dashboard-kicker">Administração</span>
                <h2 class="fs-4 fw-bold mb-0">Editar Utilizador</h2>
                <p class="text-muted mb-0">
                    Atualiza os dados, permissões e credenciais deste utilizador.
                </p>
            </div>

            <a href="{{ route('utilizadores.index') }}" class="btn btn-outline-secondary">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="dashboard-panel">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Dados do Utilizador</h4>
                            <p class="dashboard-panel-subtitle">
                                Deixa a password em branco caso não pretendas alterá-la.
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('utilizadores.update', $utilizador) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nome</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $utilizador->name) }}"
                                    required
                                >

                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $utilizador->email) }}"
                                    required
                                >

                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="role" class="form-label">Role</label>
                                <select
                                    id="role"
                                    name="role"
                                    class="form-select @error('role') is-invalid @enderror"
                                    required
                                >
                                    <option value="">Selecionar role</option>

                                    <option value="admin" {{ old('role', $utilizador->role) === 'admin' ? 'selected' : '' }}>
                                        Admin
                                    </option>

                                    <option value="vendedor" {{ old('role', $utilizador->role) === 'vendedor' ? 'selected' : '' }}>
                                        Vendedor
                                    </option>
                                </select>

                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="password" class="form-label">Nova Password</label>
                                <input
                                    type="password"
                                    id="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                >

                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <div class="form-text">
                                    Deixa em branco para manter a password atual.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirmar Nova Password</label>
                                <input
                                    type="password"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    class="form-control"
                                >
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 flex-wrap">
                            <a href="{{ route('utilizadores.show', $utilizador) }}" class="btn btn-outline-secondary">
                                Cancelar
                            </a>

                            <button type="submit" class="btn btn-primary">
                                Guardar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
