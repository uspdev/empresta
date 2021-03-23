@extends('laravel-usp-theme::master')

@section('content')
    <h1>Visitantes</h1>

    <table class="table table-striped datatable">
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
                <td>{{ $visitante->nome }}</td>
                <td>{{ $visitante->telefone }}</td>
                <td>{{ $visitante->email }}</td>
                <td>
                    <a href="/visitantes/{{$visitante->id}}"><i class="fas fa-eye"></i></a>
                    <a href="/visitantes/{{$visitante->id}}/edit"><i class="fas fa-pencil-alt"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="/visitantes/create" class="btn btn-success">Novo</a>
@endsection('content')
