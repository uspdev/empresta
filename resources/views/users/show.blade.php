@extends('laravel-usp-theme::master')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')
    <div class="row">
        <div class="col-sm">
            <div class="row float-left">
                <div class="col-auto">
                    <a href="/users/create" class="btn btn-success">Novo Usuário</a><br><br>
                </div>
            </div>
            <div class="row float-right">
                <div class="col-auto">
                    <a href="/users/{{$user->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</a>
                </div>
                <div class="col-auto">
                    <form method="POST" action="/users/{{ $user->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i> Apagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h2>Usuário</h2>
    <table class="table table-striped">
        <tbody>
            <tr>
                <th>Nome</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ $user->username }}</td>
            </tr>
            <tr>
                <th>Tipo</th>
                <td>{{ $user->tipo }}</td>
            </tr>
                   
        </tbody>
    </table>
    <a href="/users" class="btn btn-primary">Voltar</a>
@endsection('content')
