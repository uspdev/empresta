@extends('laravel-usp-theme::master')

@section('content')
@include('flash')

@inject('pessoa','App\Utils\ReplicadoUtils')

    <h3 class="mb-3">Itens Emprestados</h3>
    <input type="checkbox" name="com_prazo" id="com_prazo">
    <label for="com_prazo">Somente itens com prazo de devolução</label>
    <table class="table table-striped" id="itens-emprestados">
        <thead>
            <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Data do empréstimo</th>
                <th>Prazo de devolução</th>
                <th>Nº USP</th>
                <th>Pessoa</td>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
        @foreach($emprestimos as $emprestimo)
            <tr>
                <td>{{ $emprestimo->material->codigo }}</td>
                <td>{{ $emprestimo->material->categoria->nome }}</td>
                <td>{{ $emprestimo->material->descricao }}</td>
                <td>{{ Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y H:i') }}</td>
                <td>{{ $emprestimo->material->devolucao ? $emprestimo->material->prazo . ' dias' . ($emprestimo->material->dias_da_semana ? ' semanais' : ' corridos'): 'Não possui'}}</td>
                @if($emprestimo->visitante_id == null)
                    <td>{{ $emprestimo->username }}</td>    
                    <td> 
                        {{ implode(', ',$pessoa::pessoaUSP($emprestimo->username)) }}       
                        <br><b>Vacinação covid-19</b>: {{ \Uspdev\Replicado\Pessoa::obterSituacaoVacinaCovid19($emprestimo->username) }}
                    </td>
                @else
                    <td>&nbsp;</td>    
                    <td>{{ $emprestimo->visitante->nome }}, 
                        {{ $emprestimo->visitante->email }} <br>    
                        <i class="fas fa-phone"></i> {{ $emprestimo->visitante->telefone }}
                    </td>    
                @endif                
                <td>
                    @include('emprestimos.partials.devolver-btn')
                    <a href="emprestimos/{{$emprestimo->id}}" class="btn btn-primary col-auto ml-2"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $emprestimos->appends(request()->query())->links() }}
@endsection('content')
