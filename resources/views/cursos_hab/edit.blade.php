@extends('laravel-usp-theme::master')

@section('content')
    <div class="card mb-5">
        <div class="card-header"><b>Cadastro Curso e Habilitação x Departamento de Ensino</b></div>
        <div class="card-body">
            <form action="{{route('cursos_hab.update')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label><b>Curso / Habilitação / Período da Habilitação</b></label>
                    <select name="curso_hab" class="curso_hab form-control" required>
                        @foreach ($cursos_hab as $curso_hab)
                            <option value='{"codcur": {{$curso_hab['codcur']}}, "codhab": {{$curso_hab['codhab']}}, "nomcur": "{{$curso_hab['nomcur']}}", "nomhab": "{{$curso_hab['nomhab']}}", "perhab": "{{$curso_hab['perhab']}}"}' {{$curso_hab['codcur'] == $curso->codcur && $curso_hab['codhab'] == $curso->codhab ? 'selected': ''}}>{{$curso_hab['codcur'] . " " . $curso_hab['nomcur']}} / {{$curso_hab['codhab'] . " " . $curso_hab['nomhab']}} / {{$curso_hab['perhab']}}</option>
                        @endforeach
                    </select>
                    <small class="form-text text-muted">Os números mostrados são o código do curso e o código da habilitação respectivamente.</small>
                </div>

                <div class="form-group">
                    <label><b>Departamento de Ensino</b></label>
                    <select name="departamento_ensino" class="departamento_ensino form-control" required>
                        @foreach ($departamentos_ensino as $departamento_ensino)
                            <option value='{"codset": {{$departamento_ensino['codset']}}, "nomabvset": "{{$departamento_ensino['nomabvset']}}"}' {{$departamento_ensino['codset'] == $curso->departamento->codset ? 'selected' :''}}>{{$departamento_ensino['nomabvset']}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <button class="btn btn-success">Enviar</button>
                    <a href="{{route('cursos_hab.index')}}" class="btn btn-primary">Voltar</a>
                </div>
            </form>
        </div>
    </div>

@endsection