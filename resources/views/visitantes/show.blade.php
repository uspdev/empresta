@extends('laravel-usp-theme::master')

@section('content')
    <h1>Visitante</h1>

    <table class="table">
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
@endsection('content')
