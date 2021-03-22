@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <h1>Materiais para Empréstimo</h1>

    <a href="/materials/create" class="btn btn-success">Novo item</a>
    <br /><br />

    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($materials as $material)
            <tr>
                <td>{{ $material->codigo }}</td>
                <td>{{ $material->categoria->nome }}</td>
                <td>{{ $material->descricao }}</td>
                <td>{{ $material->ativo ? 'Sim' : 'Não' }}</td>
                <td>
                    <a href="/materials/{{$material->id}}"><i class="fas fa-eye"></i></a>
                    <a href="/materials/{{$material->id}}/edit"><i class="fas fa-pencil-alt"></i></a>
                </td>
            </tr>
        @endforeach
       </tbody>
    </table>

    <a href="materials/create" class="btn btn-success">Novo item</a>
@endsection('content')
