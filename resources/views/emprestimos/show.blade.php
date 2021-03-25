@extends('laravel-usp-theme::master')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')
    <div class="row">
        <div class="col-sm">
            <div class="row float-left">
                <div class="col-auto">
                    <a href="/emprestimos/create" class="btn btn-success">Novo Empréstimo</a><br><br>
                </div>
            </div>
            @if($emprestimo->data_devolucao == null)
                <div class="row float-right">
                    <div class="col-auto">
                        <form method="POST" action="/emprestimos/{{ $emprestimo->id }}">
                            @csrf 
                            @method('PATCH')
                            <button type="submit" class="btn btn-secondary" onclick="return confirm('Você tem certeza que deseja devolver material?')"><i class="fas fa-undo-alt"></i> Devolver</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <h2>Empréstimo:<b> {{ $emprestimo->material->descricao }}</b></h2>

    <table class="table table-striped">
        <tbody>
            <tr>
                <th>Para</th>
                <td>
                    @if($emprestimo->visitante_id == null)
                        {{ $emprestimo->codpes }} - {{ $pessoa::dump($emprestimo->codpes)['nompes'] }} - {{ $pessoa::emailusp($emprestimo->codpes) }}        
                    @else
                        {{ $emprestimo->visitante->nome }} - {{ $emprestimo->visitante->email }}    
                    @endif
                </td>
            </tr>
            <tr>
                <th>Data do Empréstimo</th>
                <td>{{ Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y') }}</td>
            </tr>
            @if($emprestimo->data_devolucao != null)
                <tr>
                    <th>Data da Devolução</th>
                    <td>{{ Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y') }}</td>
                </tr>
            @endif
            <tr>
                <th>Código</th>
                <td>{{ $emprestimo->material->codigo }}</td>
            </tr>
            <tr>
                <th>Tipo</th>
                <td>{{ $emprestimo->material->categoria->nome }}</td>
            </tr>
        </tbody>
    </table>
@endsection('content')
