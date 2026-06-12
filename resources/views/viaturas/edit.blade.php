<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2 class="fs-4 fw-bold mb-0">Editar Viatura</h2>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="card-body">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('viaturas.update', $viatura->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="marca" class="form-label">Marca</label>
                                    <input
                                        type="text"
                                        name="marca"
                                        id="marca"
                                        class="form-control @error('marca') is-invalid @enderror"
                                        value="{{ old('marca', $viatura->marca) }}"
                                    >
                                    @error('marca')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="modelo" class="form-label">Modelo</label>
                                    <input
                                        type="text"
                                        name="modelo"
                                        id="modelo"
                                        class="form-control @error('modelo') is-invalid @enderror"
                                        value="{{ old('modelo', $viatura->modelo) }}"
                                    >
                                    @error('modelo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="matricula" class="form-label">Matrícula</label>
                                    <input
                                        type="text"
                                        name="matricula"
                                        id="matricula"
                                        class="form-control @error('matricula') is-invalid @enderror"
                                        value="{{ old('matricula', $viatura->matricula) }}"
                                    >
                                    @error('matricula')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="ano" class="form-label">Ano</label>
                                    <input
                                        type="number"
                                        name="ano"
                                        id="ano"
                                        class="form-control @error('ano') is-invalid @enderror"
                                        value="{{ old('ano', $viatura->ano) }}"
                                    >
                                    @error('ano')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="cor" class="form-label">Cor</label>
                                    <input
                                        type="text"
                                        name="cor"
                                        id="cor"
                                        class="form-control @error('cor') is-invalid @enderror"
                                        value="{{ old('cor', $viatura->cor) }}"
                                    >
                                    @error('cor')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="combustivel" class="form-label">Combustível</label>
                                    <select
                                        name="combustivel"
                                        id="combustivel"
                                        class="form-select @error('combustivel') is-invalid @enderror"
                                    >
                                        <option value="">Selecione</option>
                                        <option value="Gasolina" {{ old('combustivel', $viatura->combustivel) == 'Gasolina' ? 'selected' : '' }}>Gasolina</option>
                                        <option value="Diesel" {{ old('combustivel', $viatura->combustivel) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                        <option value="Híbrido" {{ old('combustivel', $viatura->combustivel) == 'Híbrido' ? 'selected' : '' }}>Híbrido</option>
                                        <option value="Elétrico" {{ old('combustivel', $viatura->combustivel) == 'Elétrico' ? 'selected' : '' }}>Elétrico</option>
                                    </select>
                                    @error('combustivel')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="quilometragem" class="form-label">Quilometragem</label>
                                    <input
                                        type="number"
                                        name="quilometragem"
                                        id="quilometragem"
                                        class="form-control @error('quilometragem') is-invalid @enderror"
                                        value="{{ old('quilometragem', $viatura->quilometragem) }}"
                                    >
                                    @error('quilometragem')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="preco" class="form-label">Preço</label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="preco"
                                        id="preco"
                                        class="form-control @error('preco') is-invalid @enderror"
                                        value="{{ old('preco', $viatura->preco) }}"
                                    >
                                    @error('preco')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="vendido" class="form-label">Estado</label>
                                    <select
                                        name="vendido"
                                        id="vendido"
                                        class="form-select @error('vendido') is-invalid @enderror"
                                    >
                                        <option value="0" {{ old('vendido', $viatura->vendido) == '0' ? 'selected' : '' }}>Disponível</option>
                                        <option value="1" {{ old('vendido', $viatura->vendido) == '1' ? 'selected' : '' }}>Vendida</option>
                                    </select>
                                    @error('vendido')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="imagem" class="form-label">Nova Imagem</label>
                                    <input
                                        type="file"
                                        name="imagem"
                                        id="imagem"
                                        class="form-control @error('imagem') is-invalid @enderror"
                                    >
                                    @error('imagem')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                @if ($viatura->imagem)
                                    <div class="col-12">
                                        <label class="form-label d-block">Imagem Atual</label>
                                        <img
                                            src="{{ asset('storage/' . $viatura->imagem) }}"
                                            alt="Imagem atual da viatura"
                                            class="img-thumbnail"
                                            width="100%" height="100%"
                                            style="max-width: 220px;"
                                        >
                                    </div>
                                @endif
                            </div>

                            <div class="d-flex justify-content-end gap-2 mt-4">
                                <a href="{{ route('viaturas.index') }}" class="btn btn-outline-secondary">
                                    Cancelar
                                </a>
                                <button type="submit" class="btn btn-primary">
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
