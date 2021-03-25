@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <a href="/categorias/create" class="btn btn-success">Nova categoria</a><br>
    <br>
    <div class="card">
        <div class="card-body">
            <form method="GET" action="/categorias">
                <div class="row form-group">
                    <div class="col-auto">
                        <label style="margin-top:0.35em; margin-bottom:0em;"><h5><b>Buscar: </b></h5></label>
                    </div>
                </div>
                
                <div class="row form-group">
                    <div class="col-sm form-group" id="busca">
                        <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}" placeholder="Digite o nome da categoria">
                    </div>
                    <div class=" col-auto form-group">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <h1><b>Categorias dos itens de empréstimo</b></h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categorias as $categoria)
            <tr>
                <td><a href="/categorias/{{$categoria->id}}">{{ $categoria->nome }}</a></td>
                <td>
                    <a href="/categorias/{{$categoria->id}}/edit" class="btn btn-warning col-auto float-left"><i class="fas fa-pencil-alt"></i></a>
                    <form method="POST" style="width:42px;" class="float-left col-auto" action="/categorias/{{ $categoria->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $categorias->appends(request()->query())->links() }}
@endsection('content')
