@extends('laravel-usp-theme::master')

@section('content')
    <div class="row">
        <div class="col-sm">
            <div class="row float-left">
                <div class="col-auto">
                    <a href="visitantes/create" class="btn btn-success">Nova categoria</a><br><br>
                </div>
            </div>
            <div class="row float-right">
                <div class="col-auto">
                    <a href="visitantes/{{$visitante->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</a>
                </div>
                <div class="col-auto">
                    <form method="POST" action="visitantes/{{ $visitante->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i> Apagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h5><b>Visitante</b></h5>
    <table class="table table-striped">
        <tbody>
            <tr>
                <th>Id</th>
                <td>{{ $visitante->id }}</td>
            </tr>
            <tr>
                <th>Nome</th>
                <td>{{ $visitante->nome }}</td>
            </tr>
            <tr>
                <th>Telefone</th>
                <td>{{ $visitante->telefone }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $visitante->email }}</td>
            </tr>
        </tbody>
    </table>
    <a href="categorias" class="btn btn-primary">Voltar</a>
@endsection('content')
