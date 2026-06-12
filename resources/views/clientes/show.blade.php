<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2 class="fs-4 fw-bold mb-0">Detalhes do Cliente</h2>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="card-body">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="h4 fw-bold mb-4">{{ $cliente->nome }}</h3>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">ID</small>
                                    <strong>{{ $cliente->id }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Nome</small>
                                    <strong>{{ $cliente->nome }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Email</small>
                                    <strong>{{ $cliente->email }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Telefone</small>
                                    <strong>{{ $cliente->telefone }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">NIF</small>
                                    <strong>{{ $cliente->nif }}</strong>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Morada</small>
                                    <strong>{{ $cliente->morada }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('clientes.index') }}" class="btn btn-outline-secondary">
                                Voltar à Lista
                            </a>
                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary">
                                Editar Cliente
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
