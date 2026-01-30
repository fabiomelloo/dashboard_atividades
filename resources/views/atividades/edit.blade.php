@extends('layout.app')

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Editar Atividade</h5>
                    <a href="{{ route('atividades.index') }}" class="btn btn-outline-dark btn-sm">Voltar</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('atividades.update', $atividade) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo', $atividade->titulo) }}" required>
                            @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="3">{{ old('descricao', $atividade->descricao) }}</textarea>
                            @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="data_atividade" class="form-label">Data Prevista <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('data_atividade') is-invalid @enderror" id="data_atividade" name="data_atividade" value="{{ old('data_atividade', \Carbon\Carbon::parse($atividade->data_atividade)->format('Y-m-d')) }}" required>
                                @error('data_atividade') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="data_conclusao" class="form-label">Data Conclusão</label>
                                <input type="date" class="form-control @error('data_conclusao') is-invalid @enderror" id="data_conclusao" name="data_conclusao" value="{{ old('data_conclusao', $atividade->data_conclusao ? \Carbon\Carbon::parse($atividade->data_conclusao)->format('Y-m-d') : '') }}">
                                @error('data_conclusao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="prioridade" class="form-label">Prioridade <span class="text-danger">*</span></label>
                                <select class="form-select @error('prioridade') is-invalid @enderror" id="prioridade" name="prioridade" required>
                                    <option value="1" {{ old('prioridade', $atividade->prioridade) == '1' ? 'selected' : '' }}>Alta</option>
                                    <option value="2" {{ old('prioridade', $atividade->prioridade) == '2' ? 'selected' : '' }}>Média</option>
                                    <option value="3" {{ old('prioridade', $atividade->prioridade) == '3' ? 'selected' : '' }}>Baixa</option>
                                </select>
                                @error('prioridade') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="Pendente" {{ old('status', $atividade->status) == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                    <option value="Em Andamento" {{ old('status', $atividade->status) == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                                    <option value="Concluída" {{ old('status', $atividade->status) == 'Concluída' ? 'selected' : '' }}>Concluída</option>
                                    <option value="Cancelada" {{ old('status', $atividade->status) == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="responsavel" class="form-label">Responsável</label>
                                <input type="text" class="form-control @error('responsavel') is-invalid @enderror" id="responsavel" name="responsavel" value="{{ old('responsavel', $atividade->responsavel) }}">
                                @error('responsavel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="solicitante" class="form-label">Solicitante</label>
                                <input type="text" class="form-control @error('solicitante') is-invalid @enderror" id="solicitante" name="solicitante" value="{{ old('solicitante', $atividade->solicitante) }}">
                                @error('solicitante') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-warning">Atualizar Atividade</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection