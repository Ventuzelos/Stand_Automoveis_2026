<x-app-layout>
    <x-slot name="header">
        <div>
            <x-breadcrumbs :items="[
                ['label' => 'Dashboard', 'url' => route('dashboard')],
                ['label' => 'Vendas', 'url' => route('vendas.index')],
                ['label' => 'Nova Venda'],
            ]" />
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <span class="dashboard-kicker">Gestão de vendas</span>
                <h2 class="fs-4 fw-bold mb-0">Nova Venda</h2>
                <p class="text-muted mb-0">
                    Registe uma nova venda e associe o cliente à viatura vendida.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="dashboard-panel container">
        <div class="dashboard-panel-header">
            <div>
                <h4 class="dashboard-panel-title">Dados da Venda</h4>
            </div>
        </div>

        <div class="p-4">
            <form action="{{ route('vendas.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="cliente_id" class="form-label">Cliente</label>
                        <select name="cliente_id" id="cliente_id"
                            class="form-select @error('cliente_id') is-invalid @enderror">
                            <option value="">Selecione um cliente</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}"
                                    {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                                    {{ $cliente->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="viatura_id" class="form-label">Viatura</label>
                        <select name="viatura_id" id="viatura_id"
                            class="form-select @error('viatura_id') is-invalid @enderror">
                            <option value="">Selecione uma viatura</option>
                            @foreach ($viaturas as $viatura)
                                <option value="{{ $viatura->id }}"
                                    {{ old('viatura_id') == $viatura->id ? 'selected' : '' }}>
                                    {{ $viatura->marca }} {{ $viatura->modelo }} ({{ $viatura->matricula }})
                                </option>
                            @endforeach
                        </select>
                        @error('viatura_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="data_venda" class="form-label">Data da Venda</label>
                        <input type="date" name="data_venda" id="data_venda"
                            class="form-control @error('data_venda') is-invalid @enderror"
                            value="{{ old('data_venda') }}">
                        @error('data_venda')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="preco_venda" class="form-label">Valor da Venda</label>
                        <input type="number" step="0.01" name="preco_venda" id="preco_venda"
                            class="form-control @error('preco_venda') is-invalid @enderror"
                            value="{{ old('preco_venda') }}">
                        @error('preco_venda')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="observacoes" class="form-label">Observações</label>
                        <textarea name="observacoes" id="observacoes" rows="4"
                            class="form-control @error('observacoes') is-invalid @enderror">{{ old('observacoes') }}</textarea>
                        @error('observacoes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('vendas.index') }}" class="btn btn-outline-secondary">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Guardar Venda
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
