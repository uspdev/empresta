@extends('laravel-usp-theme::master')

@section('content')
@inject('pessoa','Uspdev\Replicado\Pessoa')

    <h2>Empréstimo:<b> {{ $emprestimo->material->descricao }}</b></h2>
    <div class="column"><img src="data:image/jpeg;base64,{{ $emprestimo->foto }}"></div>

    <table class="table table-striped">
        <tbody>
            <tr>
                <th>Para</th>
                <td>
                    @if($emprestimo->visitante_id == null)
                        {{ $emprestimo->username }} - {{ $pessoa::cracha($emprestimo->username)['nompescra'] }} - {{ $pessoa::emailusp($emprestimo->username) }}        
                    @else
                        {{ $emprestimo->visitante->nome }} - {{ $emprestimo->visitante->email }}    
                    @endif
                </td>
            </tr>
            <tr>
                <th>Data do Empréstimo</th>
                <td>{{ Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y H:i:s') }}</td>
            </tr>
            @if($emprestimo->data_devolucao != null)
                <tr>
                    <th>Data da Devolução</th>
                    <td>{{ Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y H:i:s') }}</td>
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
