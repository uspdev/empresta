@extends('laravel-usp-theme::master')


@section('content')
    <div>
        <div class="d-flex justify-content-end">
            <div>
                <a href="categorias/{{$categoria->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</a>
            </div>
            <div class="ml-2">
                <form method="POST" action="categorias/{{ $categoria->id }}">
                    @csrf 
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i> Apagar</button>
                </form>
            </div>
        </div>
    </div>
    <h2>{{ $categoria->nome }}</h2>
    <table class="table table-striped" style="table-layout: fixed">
            <tr scope="row">
                <td><b>Vínculos Permitidos:</b></td>
                    @if ($categoria->vinculos->isEmpty())
                        <td>Todos</td>
                    @else
                        <td>@foreach($categoria->vinculos as $vinculo) {!!'<div class="d-inline-flex mr-2">&#x1F784; ' . $vinculo->nome . '</div>'!!} @endforeach</td>
                    @endif
            </tr>
            <tr scope="row">
                <td><b>Setores e Departamentos de Ensino Permitidos:</b></td>
                    @if ($categoria->setores->isEmpty())
                        <td>Todos</td>
                    @else
                        <td>@foreach($categoria->setores as $setor) {!!'<div class="d-inline-flex mr-2">&#x1F784; ' . $setor->nomset . '</div>'!!} @endforeach</td>
                    @endif
                </tr>
    </table>
    <hr>


    
    <br><br>
    <a class="btn btn-success mb-3" href="{{route('materials.create', $categoria->id)}}">Novo Material</a>
    <h4>Materiais Desta Categoria:</h4>
    <table class="table table-striped">
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
                <td> <a href="materials/{{$material->id}}">{{$material->codigo}}</a> </td>
                <td> {{$material->categoria->nome}} </td>
                <td> {{$material->ativo ?  'Sim' : 'Não'}} </td>
                <td>
                    <a href="materials/{{$material->id}}/edit" class="btn btn-warning col-auto float-left"><i class="fas fa-pencil-alt"></i></a>
                    <form method="POST" style="width:42px;" class="float-left col-auto" action="materials/{{ $material->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="categorias" class="btn btn-primary">Voltar</a>
@endsection('content')
