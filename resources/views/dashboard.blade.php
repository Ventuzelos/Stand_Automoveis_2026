<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold mb-0">Dashboard</h2>
    </x-slot>

    <div class="container py-4">
        <div class="row g-4">
            <div class="col-12 col-md-6 col-xl-4">
                <div class="dashboard-card soft-blue">
                    <div class="label">Total de Clientes</div>
                    <div class="value">{{ $totalClientes }}</div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="dashboard-card soft-blue">
                    <div class="label">Total de Viaturas</div>
                    <div class="value">{{ $totalViaturas }}</div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="dashboard-card soft-gray">
                    <div class="label">Total de Vendas</div>
                    <div class="value">{{ $totalVendas }}</div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="dashboard-card soft-gray">
                    <div class="label">Viaturas Disponíveis</div>
                    <div class="value">{{ $viaturasDisponiveis }}</div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="dashboard-card soft-gray">
                    <div class="label">Viaturas Vendidas</div>
                    <div class="value">{{ $viaturasVendidas }}</div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="dashboard-card soft-blue">
                    <div class="label">Valor Total das Vendas</div>
                    <div class="value">{{ number_format($valorTotalVendas, 2, ',', '.') }} €</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
