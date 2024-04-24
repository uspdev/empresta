@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    @can('manager')
    <div class="row mb-3">
        <div class="col-sm">
            <a href="materials/create" class="btn btn-success">Novo Material</a>
        </div>
    </div>
    @endcan

    <h2>Materiais para Empréstimo</h2>
    <table class="table table-striped datatable">
        <thead>
            <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Prazo de devolução</th>
                <th>Ativo</th>
                @can('manager')
                <th>Ações</th>
                @endcan
            </tr>
        </thead>
        <tbody>
        @foreach($materials as $material)
            <tr>
                <td><a @can('manager') href="materials/{{$material->id}}" @endcan>{{ $material->codigo }}</a></td>
                <td>{{ $material->categoria->nome }}</td>
                <td>{{ $material->descricao }}</td>
                <td>{{$material->devolucao ? $material->prazo . ' dias ' . ($material->dias_da_semana ? 'semanais' : 'corridos') : 'Não possui'}}</td>
                <td>{{ $material->ativo ? 'Sim' : 'Não' }}</td>
                @can('manager')
                <td>
                    <a href="materials/{{$material->id}}/edit" class="btn btn-warning col-auto float-left"><i class="fas fa-pencil-alt"></i></a>
                    <form method="POST" style="width:42px;" class="float-left col-auto" action="materials/{{ $material->id }}">
                        @csrf 
                        @method('delete')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Você tem certeza que deseja apagar?')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                </td>
                @endcan
            </tr>
        @endforeach
       </tbody>
    </table>
    {{ $materials->appends(request()->query())->links() }}
@endsection('content')
