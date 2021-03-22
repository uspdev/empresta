@extends('laravel-usp-theme::master')

@section('content')
    <h1>Material</h1>

    <table class="table">
        <tbody>
            <tr>
                <th>Ativo</th>
                <td>{{ $material->ativo ? 'Sim' : 'Não' }}</td>
            </tr>
            <tr>
                <th>Código</th>
                <td>{{ $material->codigo }}</td>
            </tr>
            <tr>
                <th>Tipo</th>
                <td>{{ $material->categoria->nome }}</td>
            </tr>
            <tr>
                <th>Descrição</th>
                <td>{{ $material->descricao }}</td>
            </tr>            
        </tbody>
    </table>
    <a href="/materials/{{$material->id}}"><i class="fas fa-eye"></i> Visualizar</a>
    <a href="/materials/{{$material->id}}/edit"><i class="fas fa-pencil-alt"></i> Editar</a>
@endsection('content')
