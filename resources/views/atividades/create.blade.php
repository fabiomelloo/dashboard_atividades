@extends('layout.app')

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Nova Atividade</h5>
                    <a href="{{ route('atividades.index') }}" class="btn btn-light btn-sm">Voltar</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('atividades.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                            @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
                            @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="data_atividade" class="form-label">Data Prevista <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('data_atividade') is-invalid @enderror" id="data_atividade" name="data_atividade" value="{{ old('data_atividade', date('Y-m-d')) }}" required>
                                @error('data_atividade') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prioridade" class="form-label">Prioridade <span class="text-danger">*</span></label>
                                <select class="form-select @error('prioridade') is-invalid @enderror" id="prioridade" name="prioridade" required>
                                    <option value="1" {{ old('prioridade') == '1' ? 'selected' : '' }}>Alta</option>
                                    <option value="2" {{ old('prioridade', '2') == '2' ? 'selected' : '' }}>Média</option>
                                    <option value="3" {{ old('prioridade') == '3' ? 'selected' : '' }}>Baixa</option>
                                </select>
                                @error('prioridade') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                    <option value="Pendente" {{ old('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                                    <option value="Em Andamento" {{ old('status') == 'Em Andamento' ? 'selected' : '' }}>Em Andamento</option>
                                    <option value="Concluída" {{ old('status') == 'Concluída' ? 'selected' : '' }}>Concluída</option>
                                </select>
                                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="responsavel" class="form-label">Responsável</label>
                                <input type="text" class="form-control @error('responsavel') is-invalid @enderror" id="responsavel" name="responsavel" value="{{ old('responsavel') }}">
                                @error('responsavel') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="solicitante" class="form-label">Solicitante</label>
                            <input type="text" class="form-control @error('solicitante') is-invalid @enderror" id="solicitante" name="solicitante" value="{{ old('solicitante') }}">
                            @error('solicitante') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Salvar Atividade</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection