@extends('layout.app')

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detalhes da Atividade</h5>
                    <div>
                        <a href="{{ route('atividades.edit', $atividade) }}" class="btn btn-light btn-sm">Editar</a>
                        <a href="{{ route('atividades.index') }}" class="btn btn-outline-light btn-sm">Voltar</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <h3 class="mb-1 text-primary">{{ $atividade->titulo }}</h3>
                            <p class="text-muted"><i class="far fa-calendar-alt"></i> Criado em: {{ $atividade->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="fw-bold text-muted text-uppercase small">Descrição</label>
                            <div class="p-3 bg-light rounded border">
                                {!! nl2br(e($atividade->descricao)) ?? '<i class="text-muted">Sem descrição disponível.</i>' !!}
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="fw-bold text-muted text-uppercase small d-block">Status</label>
                            @php
                                $statusClass = match($atividade->status) {
                                    'Pendente' => 'bg-warning text-dark',
                                    'Em Andamento' => 'bg-primary',
                                    'Concluída' => 'bg-success',
                                    'Cancelada' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $statusClass }} fs-6">{{ $atividade->status }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="fw-bold text-muted text-uppercase small d-block">Prioridade</label>
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
                            <span class="badge {{ $prioridadeClass }} fs-6">{{ $prioridadeLabel }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="fw-bold text-muted text-uppercase small d-block">Data Prevista</label>
                            <span class="text-dark">{{ \Carbon\Carbon::parse($atividade->data_atividade)->format('d/m/Y') }}</span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="fw-bold text-muted text-uppercase small d-block">Responsável</label>
                            <span class="text-dark">{{ $atividade->responsavel ?? 'Não definido' }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="fw-bold text-muted text-uppercase small d-block">Solicitante</label>
                            <span class="text-dark">{{ $atividade->solicitante ?? 'Não definido' }}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="fw-bold text-muted text-uppercase small d-block">Data Conclusão</label>
                            <span class="text-dark">{{ $atividade->data_conclusao ? \Carbon\Carbon::parse($atividade->data_conclusao)->format('d/m/Y') : '-' }}</span>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <form action="{{ route('atividades.destroy', $atividade) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Tem certeza que deseja excluir esta atividade?')">
                                <i class="fas fa-trash"></i> Excluir Atividade
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
