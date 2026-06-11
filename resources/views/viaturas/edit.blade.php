<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold mb-0">Editar Viatura</h2>
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
                        <form action="{{ route('viaturas.update', $viatura->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca</label>
                                <input type="text" class="form-control" id="marca" name="marca"
                                    value="{{ old('marca', $viatura->marca) }}">
                            </div>

                            <div class="mb-3">
                                <label for="modelo" class="form-label">Modelo</label>
                                <input type="text" class="form-control" id="modelo" name="modelo"
                                    value="{{ old('modelo', $viatura->modelo) }}">
                            </div>

                            <div class="mb-3">
                                <label for="matricula" class="form-label">Matrícula</label>
                                <input type="text" class="form-control" id="matricula" name="matricula"
                                    value="{{ old('matricula', $viatura->matricula) }}">
                            </div>

                            <div class="mb-3">
                                <label for="ano" class="form-label">Ano</label>
                                <input type="number" class="form-control" id="ano" name="ano"
                                    value="{{ old('ano', $viatura->ano) }}">
                            </div>

                            <div class="mb-3">
                                <label for="cor" class="form-label">Cor</label>
                                <input type="text" class="form-control" id="cor" name="cor"
                                    value="{{ old('cor', $viatura->cor) }}">
                            </div>

                            <div class="mb-3">
                                <label for="preco" class="form-label">Preço</label>
                                <input type="number" step="0.01" class="form-control" id="preco" name="preco"
                                    value="{{ old('preco', $viatura->preco) }}">
                            </div>

                            <div class="mb-3">
                                <label for="combustivel" class="form-label">Combustível</label>
                                <select class="form-select" id="combustivel" name="combustivel">
                                    <option value="">Selecione</option>
                                    <option value="Gasolina"
                                        {{ old('combustivel', $viatura->combustivel) == 'Gasolina' ? 'selected' : '' }}>
                                        Gasolina</option>
                                    <option value="Diesel"
                                        {{ old('combustivel', $viatura->combustivel) == 'Diesel' ? 'selected' : '' }}>
                                        Diesel</option>
                                    <option value="Híbrido"
                                        {{ old('combustivel', $viatura->combustivel) == 'Híbrido' ? 'selected' : '' }}>
                                        Híbrido</option>
                                    <option value="Elétrico"
                                        {{ old('combustivel', $viatura->combustivel) == 'Elétrico' ? 'selected' : '' }}>
                                        Elétrico</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="quilometragem" class="form-label">Quilometragem</label>
                                <input type="number" class="form-control" id="quilometragem" name="quilometragem"
                                    value="{{ old('quilometragem', $viatura->quilometragem) }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Imagem atual</label><br>
                                @if ($viatura->imagem)
                                    <img src="{{ asset('storage/' . $viatura->imagem) }}" alt="Imagem da viatura"
                                        width="120" class="img-thumbnail mb-2">
                                @else
                                    <p class="text-muted">Sem imagem</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="imagem" class="form-label">Nova imagem</label>
                                <input type="file" class="form-control" id="imagem" name="imagem">
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="vendido" name="vendido"
                                    value="1" {{ old('vendido', $viatura->vendido) ? 'checked' : '' }}>
                                <label class="form-check-label" for="vendido">
                                    Viatura vendida
                                </label>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('viaturas.index') }}" class="btn btn-secondary">
                                    Voltar
                                </a>

                                <button type="submit" class="btn btn-warning">
                                    Atualizar Viatura
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
