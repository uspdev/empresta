@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="row" style="margin-bottom:0.5em;">
        <div class="col-sm">
            <a href="/materials/create" class="btn btn-success">Novo Item</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><b>Materiais para Empréstimo</b></div>
        <div class="card-body">
            <form method="GET" action="/materials">
                <div class="row">
                    <div class="col-sm" id="busca">
                        <input type="text" class="form-control" name="busca" value="{{ Request()->busca }}" placeholder="Digite o código do material">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-success">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <table class="table table-striped">
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
                <td><a href="/materials/{{$material->id}}">{{ $material->codigo }}</a></td>
                <td>{{ $material->categoria->nome }}</td>
                <td>{{ $material->descricao }}</td>
                <td>{{ $material->ativo ? 'Sim' : 'Não' }}</td>
                <td>
                    <a href="/materials/{{$material->id}}/edit" class="btn btn-warning col-auto float-left"><i class="fas fa-pencil-alt"></i></a>
                    <form method="POST" style="width:42px;" class="float-left col-auto" action="/materials/{{ $material->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
       </tbody>
    </table>
    {{ $materials->appends(request()->query())->links() }}
@endsection('content')
