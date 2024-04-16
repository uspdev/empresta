@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
@inject('pessoa','Uspdev\Replicado\Pessoa')
    <div class="card">
        <div class="card-header"><b>Relatório de Empréstimos</b></div>
        <div class="card-body">
            <form method="GET" action="emprestimos/relatorio">
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
                <th>Data do empréstimo</th>
                <th>Data da devolução</th>
                <th>Prazo de devolução</th>
                <th>Nº USP</th>
                <th>Nome</td>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
        @foreach($emprestimos as $emprestimo)
            @php
                $atrasado = 0;
                if ($emprestimo->material->devolucao) {
                    
                    if ($emprestimo->material->dias_da_semana ) 
                        $data_maxima_devolucao = date('Y-m-d H:i:s', strtotime($emprestimo->data_emprestimo . ' +' . $emprestimo->material->prazo . ' weekdays'));
                    else 
                        $data_maxima_devolucao = date('Y-m-d H:i:s', strtotime($emprestimo->data_emprestimo . ' +' . $emprestimo->material->prazo . ' days'));

                    $atrasado = $data_maxima_devolucao < $emprestimo->data_devolucao;
                }

                $prazo_de_devolucao =  $emprestimo->material->devolucao ? $emprestimo->material->prazo . ' dias' . ($emprestimo->material->dias_da_semana ? ' semanais' : ' corridos') . ($atrasado ? "<br><b>" .  Carbon\Carbon::parse($data_maxima_devolucao)->format('d/m/Y') . "</b>" : ''): 'Não possui';
            @endphp
            <tr @if($atrasado) class="table-danger" @endif>
                <td>{{ $emprestimo->material->codigo }}</td>
                <td>{{ $emprestimo->material->categoria->nome }}</td>
                <td>{{ $emprestimo->material->descricao }}</td>
                <td>{{ Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y H:i:s') }}</td>
                <td>{{ $emprestimo->data_devolucao ? Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y H:i:s') : '' }}</td>
                <td>{!! $prazo_de_devolucao !!}</td>
                @if($emprestimo->visitante_id == null)
                    <td>{{ $emprestimo->username }}</td>    
                    <td>{{ ($pessoa::dump($emprestimo->username)) ? $pessoa::dump($emprestimo->username)['nompes'] : ''}}</td>    
                    <td>{{ $pessoa::emailusp($emprestimo->username) }}</td>    
                    <td> @foreach($pessoa::telefones($emprestimo->username) as $telefone) {{ $telefone }} @endforeach</td>    
                @else
                    <td>&nbsp;</td>    
                    <td>{{ $emprestimo->visitante->nome }}</td>
                    <td>{{ $emprestimo->visitante->email }}</td>    
                    <td>{{ $emprestimo->visitante->telefone }}</td>    
                @endif                
                <td>
                    <a href="emprestimos/{{$emprestimo->id}}" class="btn btn-primary col-auto float-left"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $emprestimos->appends(request()->query())->links() }}
@endsection('content')
