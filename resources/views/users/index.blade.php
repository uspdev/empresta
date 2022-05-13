@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
@inject('pessoa','Uspdev\Replicado\Pessoa')
    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="users/create" class="btn btn-success">Novo Usuário</a><br>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><b>Usuários</b></div>
        <div class="card-body">
            <form method="GET" action="users">       
                <div class="row form-group">
                    <div class="col-sm" id="busca">
                        <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}" placeholder="Digite o nome do usuário">
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
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td><a href="users/{{$user->id}}">{{ $user->name }}</a></td>
                <td>@if($user->tipo == 'Administrador') Administrador do Sistema @else Balcão @endif</td>
                <td>
                    <a href="users/{{$user->id}}/edit" class="btn btn-warning col-auto float-left"><i class="fas fa-pencil-alt"></i></a>
                    <form method="POST" style="width:42px;" class="float-left col-auto" action="users/{{ $user->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->appends(request()->query())->links() }}
@endsection('content')
