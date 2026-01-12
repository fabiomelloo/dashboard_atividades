@extends('layout.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Editar Atividade</h1>

    <form action="{{ route('atividades.update', $atividade->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                class="form-control @error('titulo') is-invalid @enderror"
                value="{{ old('titulo', $atividade->titulo) }}"
                required
            >
            @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea
                id="descricao"
                name="descricao"
                class="form-control @error('descricao') is-invalid @enderror"
                rows="4"
            >{{ old('descricao', $atividade->descricao) }}</textarea>
            @error('descricao') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="data" class="form-label">Data</label>
                <input
                    type="date"
                    id="data"
                    name="data"
                    class="form-control @error('data') is-invalid @enderror"
                    value="{{ old('data', $atividade->data) }}"
                >
                @error('data') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="hora" class="form-label">Hora</label>
                <input
                    type="time"
                    id="hora"
                    name="hora"
                    class="form-control @error('hora') is-invalid @enderror"
                    value="{{ old('hora', $atividade->hora) }}"
                >
                @error('hora') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                    <option value="pendente" {{ old('status', $atividade->status) == 'pendente' ? 'selected' : '' }}>Pendente</option>
                    <option value="em_andamento" {{ old('status', $atividade->status) == 'em_andamento' ? 'selected' : '' }}>Em andamento</option>
                    <option value="concluida" {{ old('status', $atividade->status) == 'concluida' ? 'selected' : '' }}>Concluída</option>
                </select>
                @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="{{ route('atividades.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>
@endsection