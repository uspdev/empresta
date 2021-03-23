@extends('laravel-usp-theme::master')


@section('content')
    
    <h1>{{ $categoria->nome }} </h1>

    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categoria->materials as $material) 
            <tr>
                <td> {{$material->codigo}} </td>
                <td> {{$material->categoria->nome}} </td>
                <td> {{$material->ativo ?  'Sim' : 'Não'}} </td>
                <td>
                    <a href="materials/{{$material->id}}"><i class="fas fa-eye"></i></a>
                    <a href="materials/{{$material->id}}/edit"><i class="fas fa-pencil-alt"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection('content')
