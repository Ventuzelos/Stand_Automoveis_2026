<x-app-layout>
    <x-slot name="header">
        <div>
            <x-breadcrumbs :items="[['label' => 'Dashboard']]" />
        </div>
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

        <div class="dashboard-month-card mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">
                    <i class="bi bi-graph-up-arrow text-success"></i>
                    Desempenho do mês
                </h5>

                <span class="badge bg-success-subtle text-success">
                    {{ now()->translatedFormat('F Y') }}
                </span>
            </div>

            <div class="row g-3">
                <div class="col-md-3">
                    <div class="month-stat">
                        <strong>{{ $vendasMes }}</strong>
                        <span>Vendas</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="month-stat">
                        <strong>{{ number_format($faturacaoMes, 2, ',', '.') }} €</strong>
                        <span>Faturação</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="month-stat">
                        <strong>{{ $clientesMes }}</strong>
                        <span>Clientes novos</span>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="month-stat">
                        <strong>{{ $viaturasMes }}</strong>
                        <span>Viaturas novas</span>
                    </div>
                </div>
            </div>
        </div>
        @if (count($alertas) > 0)
            <div class="dashboard-panel mb-4">
                <div class="dashboard-panel-header">
                    <div>
                        <h4 class="dashboard-panel-title">
                            <i class="bi bi-bell me-2 text-warning"></i>
                            Notificações Operacionais
                        </h4>
                        <p class="dashboard-panel-subtitle">
                            Alertas automáticos com base no estado atual da aplicação.
                        </p>
                    </div>
                </div>

                <div class="row g-3">
                    @foreach ($alertas as $alerta)
                        <div class="col-md-4">
                            <div class="system-alert system-alert-{{ $alerta['tipo'] }}">
                                <div class="system-alert-icon">
                                    <i class="bi {{ $alerta['icone'] }}"></i>
                                </div>

                                <div>
                                    <strong>{{ $alerta['titulo'] }}</strong>
                                    <p>{{ $alerta['mensagem'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl">
                <div class="dashboard-card dashboard-stat-card ">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Melhor Venda</span>
                            <h3>{{ number_format($melhorVenda ?? 0, 2, ',', '.') }} €</h3>
                            <small class="dashboard-meta">Maior venda registada</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-trophy"></i>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl">
                <div class="dashboard-card dashboard-stat-card">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Total de Clientes</span>
                            <h3>{{ $totalClientes }}</h3>
                            <small class="dashboard-meta">Base de clientes registada</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl">
                <div class="dashboard-card dashboard-stat-card">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Total de Viaturas</span>
                            <h3>{{ $totalViaturas }}</h3>
                            <small class="dashboard-meta">Stock global inserido</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-car-front"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl">
                <div class="dashboard-card dashboard-stat-card">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Viaturas Disponíveis</span>
                            <h3>{{ $viaturasDisponiveis }}</h3>
                            <small class="dashboard-meta">Atualmente em stock</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl">
                <div class="dashboard-card dashboard-stat-card">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Viaturas Vendidas</span>
                            <h3>{{ $viaturasVendidas }}</h3>
                            <small class="dashboard-meta">Já associadas a vendas</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-tag"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Total de Vendas</span>
                            <h3>{{ $totalVendas }}</h3>
                            <small class="dashboard-meta">Operações concluídas</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-receipt"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Valor Total das Vendas</span>
                            <h3>{{ number_format($valorTotalVendas, 2, ',', '.') }} €</h3>
                            <small class="dashboard-meta">Faturação acumulada</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Taxa de Venda</span>
                            <h3>{{ $taxaVenda }}%</h3>
                            <small class="dashboard-meta">Stock convertido em vendas</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-percent"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card dashboard-stat-card">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <span class="dashboard-label">Venda Média</span>
                            <h3>{{ number_format($valorMedioVendas ?? 0, 2, ',', '.') }} €</h3>
                            <small class="dashboard-meta">Ticket médio comercial</small>
                        </div>

                        <div class="dashboard-stat-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                    </div>
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
                                            <td>{{ $venda->viatura->marca ?? '' }} {{ $venda->viatura->modelo ?? '' }}
                                            </td>
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
                                                <span
                                                    class="badge dashboard-badge dashboard-badge-muted">Vendida</span>
                                            @else
                                                <span
                                                    class="badge dashboard-badge dashboard-badge-accent">Disponível</span>
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

            <div class="col-12">
                <div class="dashboard-card h-100">
                    <div class="dashboard-card-header">
                        <h5 class="dashboard-panel-title mb-1">
                            <i class="bi bi-trophy text-warning me-2"></i>
                            Viaturas Mais Vendidas
                        </h5>
                        <p class="dashboard-card-subtitle mb-0">
                            Ranking de desempenho comercial
                        </p>
                    </div>

                    <div class="dashboard-card-body">

                        @forelse($topViaturas as $index => $item)
                            <div class="top-vehicle-row">

                                <div class="top-vehicle-position">
                                    #{{ $index + 1 }}
                                </div>

                                <div class="flex-grow-1">
                                    <strong>
                                        {{ $item->viatura->marca }}
                                        {{ $item->viatura->modelo }}
                                    </strong>
                                </div>

                                <div class="top-vehicle-sales">
                                    {{ $item->total_vendas }}
                                    vendas
                                </div>

                            </div>

                        @empty

                            <p class="text-muted mb-0">
                                Ainda não existem vendas registadas.
                            </p>
                        @endforelse

                    </div>
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
                            <span>Taxa de venda</span>
                            <strong>{{ $taxaVenda }}%</strong>
                        </div>

                        <div class="dashboard-summary-item">
                            <span>Total de vendas</span>
                            <strong>{{ $totalVendas }}</strong>
                        </div>
                    </div>

                    <div class="dashboard-stock-progress mt-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="dashboard-label">Distribuição do stock</span>
                            <strong>{{ $taxaVenda }}% vendido</strong>
                        </div>

                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" style="width: {{ 100 - $taxaVenda }}%"></div>

                            <div class="progress-bar"
                                style="width: {{ $taxaVenda }}%; background-color: #f97316;"></div>
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
                                        <div class="quick-action-icon">
                                            <i class="bi bi-person-plus"></i>
                                        </div>

                                        <div>
                                            <span class="quick-action-title">Registar Cliente</span>
                                            <small class="text-muted">Adicionar novo cliente ao sistema</small>
                                        </div>
                                    </a>
                                </div>
                            @endcan

                            @can('gerir-viaturas')
                                <div class="col-sm-6">
                                    <a href="{{ route('viaturas.create') }}" class="quick-action-card text-decoration-none">
                                        <div class="quick-action-icon">
                                            <i class="bi bi-car-front"></i>
                                        </div>

                                        <div>
                                            <span class="quick-action-title">Adicionar Viatura</span>
                                            <small class="text-muted">Inserir nova viatura no stock</small>
                                        </div>
                                    </a>
                                </div>
                            @endcan

                            @can('gerir-vendas')
                                <div class="col-sm-6">
                                    <a href="{{ route('vendas.create') }}" class="quick-action-card text-decoration-none">
                                        <div class="quick-action-icon">
                                            <i class="bi bi-receipt"></i>
                                        </div>

                                        <div>
                                            <span class="quick-action-title">Registar Venda</span>
                                            <small class="text-muted">Criar nova venda associada</small>
                                        </div>
                                    </a>
                                </div>
                            @endcan

                            @can('gerir-viaturas')
                                <div class="col-sm-6">
                                    <a href="{{ route('viaturas.index') }}" class="quick-action-card text-decoration-none">
                                        <div class="quick-action-icon">
                                            <i class="bi bi-box-seam"></i>
                                        </div>

                                        <div>
                                            <span class="quick-action-title">Ver Stock</span>
                                            <small class="text-muted">Consultar viaturas disponíveis</small>
                                        </div>
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
                            <h4 class="dashboard-panel-title">Faturação Mensal</h4>
                            <p class="dashboard-panel-subtitle">Evolução da faturação ao longo do ano</p>
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
                    label: 'Faturação (€)',
                    data: @json($chartValues),
                    backgroundColor: '#2563eb',
                    hoverBackgroundColor: '#1d4ed8',
                    borderRadius: 8,
                    borderSkipped: false
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
                    backgroundColor: ['#2563eb', '#f97316'],
                    hoverBackgroundColor: ['#1d4ed8', '#ea580c'],
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
