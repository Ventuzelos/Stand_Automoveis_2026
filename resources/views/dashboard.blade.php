<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold mb-0">Dashboard</h2>
    </x-slot>

    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card text-white bg-primary shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total de Clientes</h5>
                        <p class="card-text fs-2 fw-bold mb-0">{{ $totalClientes }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-success shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total de Viaturas</h5>
                        <p class="card-text fs-2 fw-bold mb-0">{{ $totalViaturas }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-dark shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Total de Vendas</h5>
                        <p class="card-text fs-2 fw-bold mb-0">{{ $totalVendas }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-dark bg-warning shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Viaturas Disponíveis</h5>
                        <p class="card-text fs-2 fw-bold mb-0">{{ $viaturasDisponiveis }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-danger shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Viaturas Vendidas</h5>
                        <p class="card-text fs-2 fw-bold mb-0">{{ $viaturasVendidas }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-white bg-info shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Valor Total das Vendas</h5>
                        <p class="card-text fs-3 fw-bold mb-0">
                            {{ number_format($valorTotalVendas, 2, ',', '.') }} €
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
