@extends('layout.app')

@section('conteudo')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h2">Dashboard de Atividades</h1>
            <p class="text-muted">Bem-vindo ao seu painel de controle.</p>
        </div>
        <div class="col-auto">
            <a href="{{ route('atividades.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nova Atividade
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary p-3 rounded">
                            <i class="fas fa-tasks fa-2x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="card-subtitle mb-1 text-muted">Total</h6>
                            <h2 class="card-title mb-0">{{ $stats['total'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-warning bg-opacity-10 text-warning p-3 rounded">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="card-subtitle mb-1 text-muted">Pendentes</h6>
                            <h2 class="card-title mb-0">{{ $stats['pendentes'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-success bg-opacity-10 text-success p-3 rounded">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="card-subtitle mb-1 text-muted">Concluídas</h6>
                            <h2 class="card-title mb-0">{{ $stats['concluidas'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm border-start border-danger border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-danger bg-opacity-10 text-danger p-3 rounded">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="card-subtitle mb-1 text-muted">Alta Prioridade</h6>
                            <h2 class="card-title mb-0">{{ $stats['alta_prioridade'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Activities -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Atividades Recentes</h5>
                    <a href="{{ route('atividades.index') }}" class="btn btn-sm btn-outline-primary">Ver Todas</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Título</th>
                                    <th>Status</th>
                                    <th>Prioridade</th>
                                    <th class="text-end">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentes as $atividade)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $atividade->titulo }}</div>
                                            <small class="text-muted">{{ Str::limit($atividade->descricao, 40) }}</small>
                                        </td>
                                        <td>
                                            @php
                                                $statusClass = match($atividade->status) {
                                                    'Pendente' => 'bg-warning text-dark',
                                                    'Em Andamento' => 'bg-primary',
                                                    'Concluída' => 'bg-success',
                                                    'Cancelada' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusClass }}">{{ $atividade->status }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $prioClass = match($atividade->prioridade) {
                                                    '1', 1 => 'text-danger',
                                                    '2', 2 => 'text-warning',
                                                    '3', 3 => 'text-info',
                                                    default => 'text-secondary'
                                                };
                                                $prioLabel = match($atividade->prioridade) {
                                                    '1', 1 => 'Alta',
                                                    '2', 2 => 'Média',
                                                    '3', 3 => 'Baixa',
                                                    default => $atividade->prioridade
                                                };
                                            @endphp
                                            <i class="fas fa-circle {{ $prioClass }} me-1 small"></i> {{ $prioLabel }}
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('atividades.show', $atividade) }}" class="btn btn-sm btn-light">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">Nenhuma atividade recente encontrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions / Info -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Ações Rápidas</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('atividades.create') }}" class="btn btn-primary text-start px-3 py-2">
                            <i class="fas fa-plus-circle me-2"></i> Adicionar Nova Ocorrência
                        </a>
                        <a href="{{ route('atividades.index') }}" class="btn btn-outline-secondary text-start px-3 py-2">
                            <i class="fas fa-list me-2"></i> Listar Todas as Ocorrências
                        </a>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm bg-gradient-primary text-white" style="background: linear-gradient(45deg, #4e73df, #224abe);">
                <div class="card-body py-4">
                    <h5>Resumo de Hoje</h5>
                    <p class="mb-0 opacity-75">Você tem <strong>{{ $stats['pendentes'] }}</strong> atividades pendentes esperando por você.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
