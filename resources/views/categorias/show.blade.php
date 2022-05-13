@extends('laravel-usp-theme::master')


@section('content')
    <div>
        <div class="row">
            <div class="col-sm">
                <a href="categorias/create" class="btn btn-success">Nova categoria</a><br><br>
            </div>
            <div class="col-auto float-right">
                <a href="categorias/{{$categoria->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</a>
            </div>
            <div class="col-auto pull-right">
                <form method="POST" action="categorias/{{ $categoria->id }}">
                    @csrf 
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i> Apagar</button>
                </form>
            </div>
        </div>
    </div>
    <h2>{{ $categoria->nome }}</h2>
    <div class="card card-header"><b>Materiais</b></div>
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
