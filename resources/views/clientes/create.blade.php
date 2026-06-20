<x-app-layout>
    <x-slot name="header">
        <div>
            <x-breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Clientes', 'url' => route('clientes.index')],
                ['label' => 'Novo Cliente'],
            ]" />
        </div>
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="dashboard-kicker">Base de clientes</span>
                <h2 class="fs-4 fw-bold mb-0">Novo Cliente</h2>
                <p class="text-muted mb-0">
                    Adicione um novo cliente para associar futuras vendas e histórico comercial.
                </p>
            </div>
            <div>

            </div>
        </div>
    </x-slot>
    <div class="dashboard-panel container py-4">
        <div class="dashboard-panel-header">
            <div>
                <h4 class="dashboard-panel-title">
                    Dados do Cliente
                </h4>

                {{-- <p class="dashboard-panel-subtitle">
                    Preencha os dados necessários para registar o cliente.
                </p> --}}
            </div>
        </div>

        <div class="p-4">
            <form action="{{ route('clientes.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" id="nome"
                            class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}" >
                        @error('nome')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email"
                            class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" name="telefone" id="telefone"
                            class="form-control @error('telefone') is-invalid @enderror" value="{{ old('telefone') }}">
                        @error('telefone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="nif" class="form-label">NIF</label>
                        <input type="text" name="nif" id="nif"
                            class="form-control @error('nif') is-invalid @enderror" value="{{ old('nif') }}">
                        @error('nif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="morada" class="form-label">Morada</label>
                        <input type="text" name="morada" id="morada"
                            class="form-control @error('morada') is-invalid @enderror" value="{{ old('morada') }}">
                        @error('morada')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Guardar Cliente
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
