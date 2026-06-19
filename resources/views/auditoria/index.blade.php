<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <x-breadcrumbs :items="[
                    ['label' => 'Dashboard', 'url' => route('dashboard')],
                    ['label' => 'Auditoria']
                ]" />

                <span class="dashboard-kicker">Controlo interno</span>
                <h2 class="fs-4 fw-bold mb-0">Auditoria</h2>
                <p class="text-muted mb-0">
                    Histórico de ações realizadas pelos utilizadores no sistema.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="container py-4">
        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h4 class="dashboard-panel-title">
                        <i class="bi bi-clock-history me-2 text-primary"></i>
                        Registos de atividade
                    </h4>
                    <p class="dashboard-panel-subtitle">
                        Lista cronológica das operações efetuadas no backoffice.
                    </p>
                </div>
            </div>

            @if ($logs->count())
                <div class="table-responsive d-none d-lg-block">
                    <table class="table table-hover align-middle sales-table mb-0">
                        <thead>
                            <tr>
                                <th>Utilizador</th>
                                <th>Ação</th>
                                <th>Entidade</th>
                                <th>Descrição</th>
                                <th>Data</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($logs as $log)
                                @php
                                    $actionClass = match ($log->action) {
                                        'criou' => 'bg-success-subtle text-success border border-success-subtle',
                                        'editou' => 'bg-warning-subtle text-warning border border-warning-subtle',
                                        'eliminou' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                        default => 'bg-light text-dark border',
                                    };
                                @endphp

                                <tr>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2">
                                            {{ $log->user->name ?? 'Sistema' }}
                                        </span>

                                        <div class="text-muted small mt-1">
                                            {{ $log->user->email ?? 'Sem utilizador associado' }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge {{ $actionClass }} px-3 py-2">
                                            {{ ucfirst($log->action) }}
                                        </span>
                                    </td>

                                    <td>
                                        <strong>{{ $log->entity }}</strong>
                                        @if ($log->entity_id)
                                            <div class="text-muted small">ID #{{ $log->entity_id }}</div>
                                        @endif
                                    </td>

                                    <td>{{ $log->description }}</td>

                                    <td>
                                        <strong>{{ $log->created_at->format('d/m/Y') }}</strong>
                                        <div class="text-muted small">
                                            {{ $log->created_at->format('H:i') }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="audit-mobile-list d-lg-none">
                    @foreach ($logs as $log)
                        @php
                            $actionClass = match ($log->action) {
                                'criou' => 'bg-success-subtle text-success border border-success-subtle',
                                'editou' => 'bg-warning-subtle text-warning border border-warning-subtle',
                                'eliminou' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                default => 'bg-light text-dark border',
                            };
                        @endphp

                        <div class="audit-mobile-card">
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                <div>
                                    <h3 class="h6 fw-bold mb-1">
                                        {{ $log->description }}
                                    </h3>

                                    <p class="text-muted small mb-0">
                                        {{ $log->created_at->format('d/m/Y H:i') }}
                                    </p>
                                </div>

                                <span class="badge {{ $actionClass }}">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </div>

                            <div class="audit-mobile-info">
                                <div>
                                    <span>Utilizador</span>
                                    <strong>{{ $log->user->name ?? 'Sistema' }}</strong>
                                </div>

                                <div>
                                    <span>Entidade</span>
                                    <strong>{{ $log->entity }}</strong>
                                </div>

                                <div>
                                    <span>ID</span>
                                    <strong>{{ $log->entity_id ?? '—' }}</strong>
                                </div>

                                <div>
                                    <span>Hora</span>
                                    <strong>{{ $log->created_at->format('H:i') }}</strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $logs->links() }}
                </div>
            @else
                <div class="dashboard-empty-state">
                    Ainda não existem registos de auditoria.
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
