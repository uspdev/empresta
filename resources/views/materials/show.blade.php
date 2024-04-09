@extends('laravel-usp-theme::master')

@section('content')
    @if ($material->devolucao)
        <div class="alert alert-info">Este material possui restrição de devolução de até {{$material->prazo}} dias {{$material->dias_da_semana? 'semanais': 'corridos'}}.</div>
    @endif
    <div class="row">
        <div class="col-sm">
            <div class="row float-left">
                <div class="col-auto">
                    <a href="materials/create" class="btn btn-success">Novo material</a><br><br>
                </div>
            </div>
            <div class="row float-right">
                <div class="col-auto">
                    <a href="materials/{{$material->id}}/edit" class="btn btn-warning"><i class="fas fa-pencil-alt"></i> Editar</a>
                </div>
                <div class="col-auto">
                    <form method="POST" action="materials/{{ $material->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i> Apagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h2>Material</h2>
    <table class="table table-striped">
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
    <a href="categorias" class="btn btn-primary">Voltar</a>
@endsection('content')
