<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold mb-0">Nova Venda</h2>
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
                        <form action="{{ route('vendas.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="cliente_id" class="form-label">Cliente</label>
                                <select class="form-select" id="cliente_id" name="cliente_id">
                                    <option value="">Selecione um cliente</option>
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}"
                                            {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->nome }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cliente_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="viatura_id" class="form-label">Viatura</label>
                                <select class="form-select" id="viatura_id" name="viatura_id">
                                    <option value="">Selecione uma viatura</option>
                                    @foreach ($viaturas as $viatura)
                                        <option value="{{ $viatura->id }}"
                                            {{ old('viatura_id') == $viatura->id ? 'selected' : '' }}>
                                            {{ $viatura->marca }} {{ $viatura->modelo }} - {{ $viatura->matricula }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('viatura_id')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="data_venda" class="form-label">Data da Venda</label>
                                <input type="date" class="form-control" id="data_venda" name="data_venda"
                                    value="{{ old('data_venda', date('Y-m-d')) }}">
                                @error('data_venda')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="preco_venda" class="form-label">Preço da Venda</label>
                                <input type="number" step="0.01" class="form-control" id="preco_venda"
                                    name="preco_venda" value="{{ old('preco_venda') }}">
                                @error('preco_venda')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('vendas.index') }}" class="btn btn-secondary">
                                    Voltar
                                </a>

                                <button type="submit" class="btn btn-success">
                                    Guardar Venda
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
