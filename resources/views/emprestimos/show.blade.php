@extends('laravel-usp-theme::master')

@section('content')
  @inject('pessoa','App\Utils\ReplicadoUtils')
  @include('flash')

  <h2>Empréstimo:<b> {{ $emprestimo->material->descricao }}</b></h2>


  <div class="row">
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
                <br><b>Vacinação covid-19</b>:
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
    </div>
    <div class="col-md-4">
      @if ($emprestimo->visitante_id == null)
        <div class="column"><img src="data:image/jpeg;base64,{{ $emprestimo->foto }}"></div>
      @endif
    </div>
  </div>

  @includeUnless($emprestimo->data_devolucao, 'emprestimos.partials.devolver-btn')

@endsection('content')
