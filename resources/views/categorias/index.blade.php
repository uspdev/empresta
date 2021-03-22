@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <h1>Categorias dos itens de empréstimo</h1>

    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <td>{{ $categoria->nome }}</td>
                <td>
                    <a href="/categorias/{{$categoria->id}}"><i class="fas fa-eye"></i></a>
                    <a href="/categorias/{{$categoria->id}}/edit"><i class="fas fa-pencil-alt"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="/categorias/create" class="btn btn-success">Nova categoria</a>
@endsection('content')
