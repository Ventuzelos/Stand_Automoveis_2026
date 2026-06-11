<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold mb-0">Editar Cliente</h2>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Existem erros no formulário:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('clientes.update', $cliente->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $cliente->nome) }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $cliente->email) }}">
                            </div>

                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone) }}">
                            </div>

                            <div class="mb-3">
                                <label for="nif" class="form-label">NIF</label>
                                <input type="text" class="form-control" id="nif" name="nif" value="{{ old('nif', $cliente->nif) }}">
                            </div>

                            <div class="mb-3">
                                <label for="morada" class="form-label">Morada</label>
                                <input type="text" class="form-control" id="morada" name="morada" value="{{ old('morada', $cliente->morada) }}">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                                    Voltar
                                </a>

                                <button type="submit" class="btn btn-warning">
                                    Atualizar Cliente
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
