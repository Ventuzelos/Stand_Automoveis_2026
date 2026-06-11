<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold mb-0">Nova Viatura</h2>
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
                        <form action="{{ route('viaturas.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca"
                                    value="{{ old('marca') }}">
                            </div>

                            <div class="mb-3">
                                <label for="modelo" class="form-label">Modelo</label>
                                <input type="text" class="form-control" id="modelo" name="modelo"
                                    value="{{ old('modelo') }}">
                            </div>

                            <div class="mb-3">
                                <label for="matricula" class="form-label">Matrícula</label>
                                <input type="text" class="form-control" id="matricula" name="matricula"
                                    value="{{ old('matricula') }}">
                            </div>

                            <div class="mb-3">
                                <label for="ano" class="form-label">Ano</label>
                                <input type="number" class="form-control" id="ano" name="ano"
                                    value="{{ old('ano') }}">
                            </div>

                            <div class="mb-3">
                                <label for="cor" class="form-label">Cor</label>
                                <input type="text" class="form-control" id="cor" name="cor"
                                    value="{{ old('cor') }}">
                            </div>

                            <div class="mb-3">
                                <label for="preco" class="form-label">Preço</label>
                                <input type="number" step="0.01" class="form-control" id="preco" name="preco"
                                    value="{{ old('preco') }}">
                            </div>

                            <div class="mb-3">
                                <label for="combustivel" class="form-label">Combustível</label>
                                <select class="form-select" id="combustivel" name="combustivel">
                                    <option value="">Selecione</option>
                                    <option value="Gasolina" {{ old('combustivel') == 'Gasolina' ? 'selected' : '' }}>
                                        Gasolina</option>
                                    <option value="Diesel" {{ old('combustivel') == 'Diesel' ? 'selected' : '' }}>Diesel
                                    </option>
                                    <option value="Híbrido" {{ old('combustivel') == 'Híbrido' ? 'selected' : '' }}>
                                        Híbrido</option>
                                    <option value="Elétrico" {{ old('combustivel') == 'Elétrico' ? 'selected' : '' }}>
                                        Elétrico</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="quilometragem" class="form-label">Quilometragem</label>
                                <input type="number" class="form-control" id="quilometragem" name="quilometragem"
                                    value="{{ old('quilometragem') }}">
                            </div>

                            <div class="mb-3">
                                <label for="imagem" class="form-label">Imagem</label>
                                <input type="file" class="form-control" id="imagem" name="imagem">
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="vendido" name="vendido"
                                    value="1" {{ old('vendido') ? 'checked' : '' }}>
                                <label class="form-check-label" for="vendido">
                                    Viatura vendida
                                </label>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('viaturas.index') }}" class="btn btn-secondary">
                                    Voltar
                                </a>

                                <button type="submit" class="btn btn-success">
                                    Guardar Viatura
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
