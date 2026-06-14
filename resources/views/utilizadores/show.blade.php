<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2 class="fs-4 fw-bold mb-0">Detalhes do Utilizador</h2>
        </div>
    </x-slot>

    <div class="container py-4">
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="card-body">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="h4 fw-bold mb-4">{{ $utilizador->name }}</h3>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">ID</small>
                                    <strong>{{ $utilizador->id }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Nome</small>
                                    <strong>{{ $utilizador->name }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Email</small>
                                    <strong>{{ $utilizador->email }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Role</small>
                                    <div>
                                        @if ($utilizador->role === 'admin')
                                            <span class="badge bg-dark">Admin</span>
                                        @else
                                            <span class="badge bg-secondary">Vendedor</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Email verificado</small>
                                    <div>
                                        @if ($utilizador->email_verified_at)
                                            <span class="badge bg-success">Sim</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Não</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Criado em</small>
                                    <strong>{{ $utilizador->created_at?->format('d/m/Y H:i') ?? '—' }}</strong>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded p-3 h-100">
                                    <small class="text-muted d-block mb-1">Última atualização</small>
                                    <strong>{{ $utilizador->updated_at?->format('d/m/Y H:i') ?? '—' }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4 flex-wrap">
                            <a href="{{ route('utilizadores.index') }}" class="btn btn-outline-secondary">
                                Voltar à Lista
                            </a>

                            <a href="{{ route('utilizadores.edit', $utilizador->id) }}" class="btn btn-primary">
                                Editar Utilizador
                            </a>

                            @if (auth()->id() !== $utilizador->id)
                                <form action="{{ route('utilizadores.destroy', $utilizador->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Tens a certeza que queres eliminar este utilizador?')">
                                        Eliminar
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
