@extends('layout.app')

@section('content')
<div class="container">
    <h1>Criar Atividade</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('atividades.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" id="titulo" name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ old('titulo') }}" required>
            @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea id="descricao" name="descricao" rows="4" class="form-control @error('descricao') is-invalid @enderror">{{ old('descricao') }}</textarea>
            @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row g-3 mb-3">
               <div class="col-md-4">
                <label for="data_atividade" class="form-label">Data da Atividade</label>
                <input type="date" id="data_atividade" name="data_atividade" class="form-control @error('data_atividade') is-invalid @enderror" value="{{ old('data_atividade') }}">
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-4">
                <label for="data_atividade" class="form-label">Data</label>
                <input type="date" id="data_atividade" name="data_atividade" class="form-control @error('data_atividade') is-invalid @enderror" value="{{ old('data_atividade') }}">
                @error('data_atividade') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="hora" class="form-label">Hora</label>
                <input type="time" id="hora" name="hora" class="form-control @error('hora') is-invalid @enderror" value="{{ old('hora') }}">
                @error('hora') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4">
                <label for="prioridade" class="form-label">Prioridade</label>
                <select id="prioridade" name="prioridade" class="form-select @error('prioridade') is-invalid @enderror">
                    <option value="">-- selecione --</option>
                    <option value="baixa" {{ old('prioridade')=='baixa' ? 'selected' : '' }}>Baixa</option>
                    <option value="media" {{ old('prioridade')=='media' ? 'selected' : '' }}>Média</option>
                    <option value="alta" {{ old('prioridade')=='alta' ? 'selected' : '' }}>Alta</option>
                </select>
                @error('prioridade') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        @if(isset($projetos) && $projetos->count())
            <div class="mb-3">
                <label for="projeto_id" class="form-label">Projeto (opcional)</label>
                <select id="projeto_id" name="projeto_id" class="form-select @error('projeto_id') is-invalid @enderror">
                    <option value="">-- nenhum --</option>
                    @foreach($projetos as $projeto)
                        <option value="{{ $projeto->id }}" {{ old('projeto_id') == $projeto->id ? 'selected' : '' }}>{{ $projeto->nome ?? $projeto->title ?? 'Projeto '.$projeto->id }}</option>
                    @endforeach
                </select>
                @error('projeto_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        @endif

        <div class="form-check mb-3">
            <input type="hidden" name="concluida" value="0">
            <input class="form-check-input" type="checkbox" id="concluida" name="concluida" value="1" {{ old('concluida') ? 'checked' : '' }}>
            <label class="form-check-label" for="concluida">Concluída</label>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('atividades.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection