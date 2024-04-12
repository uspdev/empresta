@extends('laravel-usp-theme::master')

@section('content')
  @inject('pessoa','App\Utils\ReplicadoUtils')
  @include('flash')
  @if ($emprestimo->material->devolucao && is_null($emprestimo->data_devolucao))
    @if ($emprestimo->material->dias_da_semana)
      <div class="alert alert-warning">Prazo de devolução até <b>{{date('d/m/Y', strtotime($emprestimo->data_emprestimo . ' +' . $emprestimo->material->prazo . ' weekdays'))}}</b></div>
    @else
      <div class="alert alert-warning">Prazo de devolução até <b>{{date('d/m/Y', strtotime($emprestimo->data_emprestimo . ' +' . $emprestimo->material->prazo . ' days'))}}</b></div>
    @endif
  @endif

  <h2>Empréstimo:<b> ({{ $emprestimo->material->categoria->nome }}) {{ $emprestimo->material->descricao }}</b></h2>

  <div class="row mb-3">
    <div class="col-md-8">
      <table class="table table-striped">
        <tbody>
          <tr>
            <th>Para</th>
            <td>
              @if ($emprestimo->visitante_id == null)
                {{ $emprestimo->username }}
                @foreach ($pessoa::pessoaUSP($emprestimo->username) as $data)
                  <br>{{ $data }}
                @endforeach
                <br><b>Vínculos e Setores:</b>
                <ul class="mb-2">
                  @foreach ($pessoa::vinculos($emprestimo->username) as $vinculo)
                      <li>{{$vinculo}}</li>
                  @endforeach
                </ul>
                <b>Vacinação covid-19</b>:
                {{ \Uspdev\Replicado\Pessoa::obterSituacaoVacinaCovid19($emprestimo->username) }}
              @else
                {{ $emprestimo->visitante->nome }} - {{ $emprestimo->visitante->email }}
              @endif
            </td>
          </tr>
          <tr>
            <th>Data do Empréstimo</th>
            <td>{{ Carbon\Carbon::parse($emprestimo->data_emprestimo)->format('d/m/Y H:i:s') }}</td>
          </tr>
          @if ($emprestimo->data_devolucao != null)
            <tr>
              <th>Data da Devolução</th>
              <td>{{ Carbon\Carbon::parse($emprestimo->data_devolucao)->format('d/m/Y H:i:s') }}</td>
            </tr>

            @php
                $atrasado = 0;
                if ($emprestimo->material->devolucao) {
                    
                    if ($emprestimo->material->dias_da_semana ) 
                        $data_devolucao = date('Y-m-d H:i:s', strtotime($emprestimo->data_emprestimo . ' +' . $emprestimo->material->prazo . ' weekdays'));
                    else 
                        $data_devolucao = date('Y-m-d H:i:s', strtotime($emprestimo->data_emprestimo . ' +' . $emprestimo->material->prazo . ' days'));

                    $atrasado = $data_devolucao < now();
                }

                $prazo_de_devolucao =  $emprestimo->material->devolucao ? $emprestimo->material->prazo . ' dias' . ($emprestimo->material->dias_da_semana ? ' semanais' : ' corridos') . ($atrasado ? "<br><b>" .  Carbon\Carbon::parse($data_devolucao)->format('d/m/Y') . "</b>" : ''): 'Não possui';
            @endphp

            <tr @if($atrasado) class="table-danger" @endif>
              <th>Prazo de Devolução</th>
              <td>{!!$prazo_de_devolucao!!}</td>
            </tr>
          @endif
          <tr>
            <th>Código</th>
            <td>{{ $emprestimo->material->codigo }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-4">
      @if ($emprestimo->visitante_id == null)
        <div class="column"><img src="data:image/jpeg;base64,{{ $emprestimo->foto }}"></div>
      @endif
    </div>
  </div>

  @includeUnless($emprestimo->data_devolucao, 'emprestimos.partials.devolver-btn')

@endsection('content')
