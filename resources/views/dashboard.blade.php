<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div class="dashboard-header-content">
                <h2 class="dashboard-page-title">Dashboard</h2>
                <p class="dashboard-page-subtitle">Visão geral da atividade do stand.</p>
            </div>

            <div class="dashboard-header-actions">
                <a href="{{ route('clientes.create') }}" class="btn btn-outline-primary">
                    Novo Cliente
                </a>
                <a href="{{ route('viaturas.create') }}" class="btn btn-outline-primary">
                    Nova Viatura
                </a>
                <a href="{{ route('vendas.create') }}" class="btn btn-primary">
                    Nova Venda
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-card-primary">
                    <span class="dashboard-label">Total de Clientes</span>
                    <h3>{{ $totalClientes }}</h3>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-card-primary">
                    <span class="dashboard-label">Total de Viaturas</span>
                    <h3>{{ $totalViaturas }}</h3>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-card-neutral">
                    <span class="dashboard-label">Viaturas Disponíveis</span>
                    <h3>{{ $viaturasDisponiveis }}</h3>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-card-neutral">
                    <span class="dashboard-label">Viaturas Vendidas</span>
                    <h3>{{ $viaturasVendidas }}</h3>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="dashboard-card dashboard-card-primary">
                    <span class="dashboard-label">Total de Vendas</span>
                    <h3>{{ $totalVendas }}</h3>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="dashboard-card dashboard-card-primary">
                    <span class="dashboard-label">Valor Total das Vendas</span>
                    <h3>{{ number_format($valorTotalVendas, 2, ',', '.') }} €</h3>
                </div>
            </div>

            <div class="col-md-6 col-xl-2">
                <div class="dashboard-card dashboard-card-neutral">
                    <span class="dashboard-label">Preço Médio Viaturas</span>
                    <h3>{{ number_format($precoMedioViaturas ?? 0, 2, ',', '.') }} €</h3>
                </div>
            </div>

            <div class="col-md-6 col-xl-2">
                <div class="dashboard-card dashboard-card-neutral">
                    <span class="dashboard-label">Venda Média</span>
                    <h3>{{ number_format($valorMedioVendas ?? 0, 2, ',', '.') }} €</h3>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-xl-7">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                            <h4 class="h5 fw-bold mb-0">Últimas Vendas</h4>
                            <a href="{{ route('vendas.index') }}" class="btn btn-sm btn-outline-secondary">Ver
                                todas</a>
                        </div>

                        @if ($ultimasVendas->count())
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Viatura</th>
                                            <th>Data</th>
                                            <th>Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ultimasVendas as $venda)
                                            <tr>
                                                <td>{{ $venda->cliente->nome ?? '—' }}</td>
                                                <td>
                                                    {{ $venda->viatura->marca ?? '' }}
                                                    {{ $venda->viatura->modelo ?? '' }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}
                                                </td>
                                                <td>{{ number_format($venda->preco_venda, 2, ',', '.') }} €</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-light mb-0">
                                Ainda não existem vendas registadas.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-5">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                            <h4 class="h5 fw-bold mb-0">Viaturas Recentes</h4>
                            <a href="{{ route('viaturas.index') }}" class="btn btn-sm btn-outline-secondary">Ver
                                todas</a>
                        </div>

                        @if ($ultimasViaturas->count())
                            <div class="list-group list-group-flush">
                                @foreach ($ultimasViaturas as $viatura)
                                    <div class="list-group-item px-0">
                                        <div class="d-flex justify-content-between align-items-start gap-3">
                                            <div>
                                                <div class="fw-semibold">
                                                    {{ $viatura->marca }} {{ $viatura->modelo }}
                                                </div>
                                                <div class="text-muted small">
                                                    {{ $viatura->matricula }} · {{ $viatura->ano }}
                                                </div>
                                            </div>

                                            <div class="text-end">
                                                <div class="fw-semibold">
                                                    {{ number_format($viatura->preco, 2, ',', '.') }} €
                                                </div>
                                                @if ($viatura->vendido)
                                                    <span class="badge bg-danger">Vendida</span>
                                                @else
                                                    <span class="badge bg-success">Disponível</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-light mb-0">
                                Ainda não existem viaturas registadas.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="h5 fw-bold mb-3">Resumo Operacional</h4>

                        <div class="dashboard-summary-list">
                            <div class="dashboard-summary-item">
                                <span>Clientes registados</span>
                                <strong>{{ $totalClientes }}</strong>
                            </div>
                            <div class="dashboard-summary-item">
                                <span>Viaturas em stock</span>
                                <strong>{{ $viaturasDisponiveis }}</strong>
                            </div>
                            <div class="dashboard-summary-item">
                                <span>Viaturas vendidas</span>
                                <strong>{{ $viaturasVendidas }}</strong>
                            </div>
                            <div class="dashboard-summary-item">
                                <span>Total de vendas</span>
                                <strong>{{ $totalVendas }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h4 class="h5 fw-bold mb-3">Ações Rápidas</h4>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <a href="{{ route('clientes.create') }}"
                                    class="quick-action-card text-decoration-none">
                                    <span class="quick-action-title">Registar Cliente</span>
                                    <small class="text-muted">Adicionar novo cliente ao sistema</small>
                                </a>
                            </div>

                            <div class="col-sm-6">
                                <a href="{{ route('viaturas.create') }}"
                                    class="quick-action-card text-decoration-none">
                                    <span class="quick-action-title">Adicionar Viatura</span>
                                    <small class="text-muted">Inserir nova viatura no stock</small>
                                </a>
                            </div>

                            <div class="col-sm-6">
                                <a href="{{ route('vendas.create') }}" class="quick-action-card text-decoration-none">
                                    <span class="quick-action-title">Registar Venda</span>
                                    <small class="text-muted">Criar nova venda associada</small>
                                </a>
                            </div>

                            <div class="col-sm-6">
                                <a href="{{ route('viaturas.index') }}" class="quick-action-card text-decoration-none">
                                    <span class="quick-action-title">Ver Stock</span>
                                    <small class="text-muted">Consultar viaturas disponíveis</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-1">
            <div class="col-xl-7">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                            <h4 class="h5 fw-bold mb-0">Vendas Recentes</h4>
                            <span class="text-muted small">Total por data de venda</span>
                        </div>
                        <div class="chart-container">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-5">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                            <h4 class="h5 fw-bold mb-0">Estado do Stock</h4>
                            <span class="text-muted small">Disponíveis vs vendidas</span>
                        </div>
                        <div class="chart-container chart-container-small">
                            <canvas id="stockChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const salesCtx = document.getElementById('salesChart');
        const stockCtx = document.getElementById('stockChart');

        new Chart(salesCtx, {
            type: 'bar',
            data: {
                labels: @json($chartLabels),
                datasets: [{
                    label: 'Valor das vendas (€)',
                    data: @json($chartValues),
                    backgroundColor: '#2563eb',
                    borderRadius: 8,
                    maxBarThickness: 42
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('pt-PT') + ' €';
                            }
                        }
                    }
                }
            }
        });

        new Chart(stockCtx, {
            type: 'doughnut',
            data: {
                labels: ['Disponíveis', 'Vendidas'],
                datasets: [{
                    data: [{{ $viaturasDisponiveis }}, {{ $viaturasVendidas }}],
                    backgroundColor: ['#16a34a', '#dc2626'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</x-app-layout>
