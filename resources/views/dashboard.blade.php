<x-app-layout>
    <x-slot name="header">
        <div class="dashboard-header">
            <div class="dashboard-header-content">
                <span class="dashboard-kicker">Painel principal</span>
                <h2 class="dashboard-page-title">Dashboard</h2>
                <p class="dashboard-page-subtitle">Visão geral da atividade comercial, stock e desempenho do stand.</p>
            </div>

            @canany(['gerir-clientes', 'gerir-viaturas', 'gerir-vendas'])
                <div class="dashboard-header-actions">
                    @can('gerir-clientes')
                        <a href="{{ route('clientes.create') }}" class="btn btn-outline-primary">
                            Novo Cliente
                        </a>
                    @endcan

                    @can('gerir-viaturas')
                        <a href="{{ route('viaturas.create') }}" class="btn btn-outline-primary">
                            Nova Viatura
                        </a>
                    @endcan

                    @can('gerir-vendas')
                        <a href="{{ route('vendas.create') }}" class="btn btn-primary">
                            Nova Venda
                        </a>
                    @endcan
                </div>
            @endcanany
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card dashboard-card-accent">
                    <span class="dashboard-label">Total de Clientes</span>
                    <h3>{{ $totalClientes }}</h3>
                    <small class="dashboard-meta">Base de clientes registada</small>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card dashboard-card-accent">
                    <span class="dashboard-label">Total de Viaturas</span>
                    <h3>{{ $totalViaturas }}</h3>
                    <small class="dashboard-meta">Stock global inserido</small>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card dashboard-card-soft">
                    <span class="dashboard-label">Viaturas Disponíveis</span>
                    <h3>{{ $viaturasDisponiveis }}</h3>
                    <small class="dashboard-meta">Atualmente em stock</small>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card dashboard-card-soft">
                    <span class="dashboard-label">Viaturas Vendidas</span>
                    <h3>{{ $viaturasVendidas }}</h3>
                    <small class="dashboard-meta">Já associadas a vendas</small>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-4">
                <div class="dashboard-card dashboard-stat-card dashboard-card-accent">
                    <span class="dashboard-label">Total de Vendas</span>
                    <h3>{{ $totalVendas }}</h3>
                    <small class="dashboard-meta">Operações concluídas</small>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="dashboard-card dashboard-stat-card dashboard-card-accent">
                    <span class="dashboard-label">Valor Total das Vendas</span>
                    <h3>{{ number_format($valorTotalVendas, 2, ',', '.') }} €</h3>
                    <small class="dashboard-meta">Faturação acumulada</small>
                </div>
            </div>

            <div class="col-md-6 col-xl-2">
                <div class="dashboard-card dashboard-stat-card dashboard-card-soft">
                    <span class="dashboard-label">Preço Médio Viaturas</span>
                    <h3>{{ number_format($precoMedioViaturas ?? 0, 2, ',', '.') }} €</h3>
                    <small class="dashboard-meta">Valor médio do catálogo</small>
                </div>
            </div>

            <div class="col-md-6 col-xl-2">
                <div class="dashboard-card dashboard-stat-card dashboard-card-soft">
                    <span class="dashboard-label">Venda Média</span>
                    <h3>{{ number_format($valorMedioVendas ?? 0, 2, ',', '.') }} €</h3>
                    <small class="dashboard-meta">Ticket médio comercial</small>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-xl-7">
                <div class="dashboard-panel h-100">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Últimas Vendas</h4>
                            <p class="dashboard-panel-subtitle">Registos mais recentes efetuados no sistema</p>
                        </div>

                        @can('gerir-vendas')
                            <a href="{{ route('vendas.index') }}" class="btn btn-sm btn-outline-secondary">
                                Ver todas
                            </a>
                        @endcan
                    </div>

                    @if ($ultimasVendas->count())
                        <div class="table-responsive">
                            <table class="table dashboard-table align-middle mb-0">
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
                                            <td>{{ $venda->viatura->marca ?? '' }} {{ $venda->viatura->modelo ?? '' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($venda->data_venda)->format('d/m/Y') }}</td>
                                            <td>{{ number_format($venda->preco_venda, 2, ',', '.') }} €</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="dashboard-empty-state">
                            Ainda não existem vendas registadas.
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-xl-5">
                <div class="dashboard-panel h-100">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Viaturas Recentes</h4>
                            <p class="dashboard-panel-subtitle">Últimas viaturas adicionadas ao stock</p>
                        </div>

                        @can('gerir-viaturas')
                            <a href="{{ route('viaturas.index') }}" class="btn btn-sm btn-outline-secondary">
                                Ver todas
                            </a>
                        @endcan
                    </div>

                    @if ($ultimasViaturas->count())
                        <div class="list-group list-group-flush">
                            @foreach ($ultimasViaturas as $viatura)
                                <div class="list-group-item px-0 dashboard-list-item">
                                    <div class="d-flex justify-content-between align-items-start gap-3">
                                        <div>
                                            <div class="fw-semibold">{{ $viatura->marca }} {{ $viatura->modelo }}</div>
                                            <div class="text-muted small">{{ $viatura->matricula }} · {{ $viatura->ano }}</div>
                                        </div>

                                        <div class="text-end">
                                            <div class="fw-semibold">{{ number_format($viatura->preco, 2, ',', '.') }} €</div>
                                            @if ($viatura->vendido)
                                                <span class="badge dashboard-badge dashboard-badge-muted">Vendida</span>
                                            @else
                                                <span class="badge dashboard-badge dashboard-badge-accent">Disponível</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="dashboard-empty-state">
                            Ainda não existem viaturas registadas.
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-xl-6">
                <div class="dashboard-panel h-100">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Resumo Operacional</h4>
                            <p class="dashboard-panel-subtitle">Indicadores rápidos do estado atual do stand</p>
                        </div>
                    </div>

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

            @canany(['gerir-clientes', 'gerir-viaturas', 'gerir-vendas'])
                <div class="col-xl-6">
                    <div class="dashboard-panel h-100">
                        <div class="dashboard-panel-header">
                            <div>
                                <h4 class="dashboard-panel-title">Ações Rápidas</h4>
                                <p class="dashboard-panel-subtitle">Atalhos para as operações mais frequentes</p>
                            </div>
                        </div>

                        <div class="row g-3">
                            @can('gerir-clientes')
                                <div class="col-sm-6">
                                    <a href="{{ route('clientes.create') }}" class="quick-action-card text-decoration-none">
                                        <span class="quick-action-title">Registar Cliente</span>
                                        <small class="text-muted">Adicionar novo cliente ao sistema</small>
                                    </a>
                                </div>
                            @endcan

                            @can('gerir-viaturas')
                                <div class="col-sm-6">
                                    <a href="{{ route('viaturas.create') }}" class="quick-action-card text-decoration-none">
                                        <span class="quick-action-title">Adicionar Viatura</span>
                                        <small class="text-muted">Inserir nova viatura no stock</small>
                                    </a>
                                </div>
                            @endcan

                            @can('gerir-vendas')
                                <div class="col-sm-6">
                                    <a href="{{ route('vendas.create') }}" class="quick-action-card text-decoration-none">
                                        <span class="quick-action-title">Registar Venda</span>
                                        <small class="text-muted">Criar nova venda associada</small>
                                    </a>
                                </div>
                            @endcan

                            @can('gerir-viaturas')
                                <div class="col-sm-6">
                                    <a href="{{ route('viaturas.index') }}" class="quick-action-card text-decoration-none">
                                        <span class="quick-action-title">Ver Stock</span>
                                        <small class="text-muted">Consultar viaturas disponíveis</small>
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            @endcanany
        </div>

        <div class="row g-4">
            <div class="col-xl-7">
                <div class="dashboard-panel h-100">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Vendas Recentes</h4>
                            <p class="dashboard-panel-subtitle">Total por data de venda</p>
                        </div>
                    </div>

                    <div class="chart-container">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-5">
                <div class="dashboard-panel h-100">
                    <div class="dashboard-panel-header">
                        <div>
                            <h4 class="dashboard-panel-title">Estado do Stock</h4>
                            <p class="dashboard-panel-subtitle">Distribuição entre disponíveis e vendidas</p>
                        </div>
                    </div>

                    <div class="chart-container chart-container-small">
                        <canvas id="stockChart"></canvas>
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
                labels: {{ \Illuminate\Support\Js::from($chartLabels) }},
                datasets: [{
                    label: 'Valor das vendas (€)',
                    data: {{ \Illuminate\Support\Js::from($chartValues) }},
                    backgroundColor: '#2563eb',
                    hoverBackgroundColor: '#1d4ed8',
                    borderRadius: 10,
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
                            callback: function (value) {
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
                    backgroundColor: ['#2563eb', '#94a3b8'],
                    hoverBackgroundColor: ['#1d4ed8', '#64748b'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '68%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#475569',
                            usePointStyle: true,
                            pointStyle: 'circle',
                            padding: 18
                        }
                    }
                }
            }
        });
    </script>
</x-app-layout>
