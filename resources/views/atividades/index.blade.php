@extends('layout.app')

@section('conteudo')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Minhas Ocorrências</h1>
        <a href="{{ route('atividades.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nova Ocorrência 
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Título</th>
                            <th>Data</th>
                            <th>Prioridade</th>
                            <th>Status</th>
                            <th>Responsável</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($atividades as $atividade)
                            <tr>
                                <td class="align-middle">
                                    <h6 class="mb-0">{{ $atividade->titulo }}</h6>
                                    <small class="text-muted">{{ Str::limit($atividade->descricao, 50) }}</small>
                                </td>
                                <td class="align-middle text-nowrap">
                                    {{ \Carbon\Carbon::parse($atividade->data_atividade)->format('d/m/Y') }}
                                </td>
                                <td class="align-middle">
                                    @php
                                        $prioridadeClass = match($atividade->prioridade) {
                                            '1', 1 => 'bg-danger',
                                            '2', 2 => 'bg-warning text-dark',
                                            '3', 3 => 'bg-info text-dark',
                                            default => 'bg-secondary'
                                        };
                                        $prioridadeLabel = match($atividade->prioridade) {
                                            '1', 1 => 'Alta',
                                            '2', 2 => 'Média',
                                            '3', 3 => 'Baixa',
                                            default => $atividade->prioridade
                                        };
                                    @endphp
                                    <span class="badge {{ $prioridadeClass }}">{{ $prioridadeLabel }}</span>
                                </td>
                                <td class="align-middle">
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
                                <td class="align-middle">{{ $atividade->responsavel ?? 'N/A' }}</td>
                                <td class="text-end align-middle">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('atividades.show', $atividade) }}" class="btn btn-outline-info" title="Visualizar">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('atividades.edit', $atividade) }}" class="btn btn-outline-primary" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('atividades.destroy', $atividade) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir esta atividade?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">Nenhuma atividade encontrada.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $atividades->links() }}
    </div>
@endsection