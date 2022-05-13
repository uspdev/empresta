@extends('laravel-usp-theme::master')

@section('content')
    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="visitantes/create" class="btn btn-success">Novo Visitante</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><b>Visitantes</b></div>
        <div class="card-body">
            <form method="GET" action="visitantes">
                <div class="row form-group">
                    <div class="col-sm" id="busca">
                        <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}" placeholder="Digite o código do material">
                    </div>
                    <div class=" col-auto">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($visitantes as $visitante)
            <tr>
                <td><a href="visitantes/{{$visitante->id}}">{{ $visitante->nome }}</a></td>
                <td>{{ $visitante->telefone }}</td>
                <td>{{ $visitante->email }}</td>
                <td>
                    <a href="visitantes/{{$visitante->id}}/edit" class="btn btn-warning col-auto float-left"><i class="fas fa-pencil-alt"></i></a>
                    <form method="POST" style="width:42px;" class="float-left col-auto" action="visitantes/{{ $visitante->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $visitantes->appends(request()->query())->links() }}
@endsection('content')
