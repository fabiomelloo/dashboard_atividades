<!DOCTYPE html>
<html lang="en">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard de Atividades</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZmK9OlkOP+XkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head> 
<body>
     @extends('layout.app') 
        @section('content')
        <h1 class="mb-4">Dashboard de Atividades</h1>
        <a href="{{ route('atividades.create') }}" class="btn btn-primary mb-3">Adicionar Atividade</a>
        <table class="table table-striped"> 
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($atividades as $atividade)
                <tr>
                    <td>{{ $atividade->id }}</td>
                    <td>{{ $atividade->titulo }}</td>
                    <td>{{ $atividade->descricao }}</td>
                    <td>{{ $atividade->status }}</td>
                    <td>
                        <a href="{{ route('atividades.editar', $atividade->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        @if($atividade->status == 'Pendente')
                            <a href="{{ route('atividades.concluir', $atividade->id) }}" class="btn btn-sm btn-success">Concluir</a>
                        @else
                            <a href="{{ route('atividades.reabrir', $atividade->id) }}" class="btn btn-sm btn-secondary">Reabrir</a>
                        @endif
                        <form action="{{ route('atividades.destroy', $atividade->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja deletar esta atividade?')">Deletar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endsection 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>    
</body>
</html>

    