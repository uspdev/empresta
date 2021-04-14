@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><h4><b>Novo Empréstimo</b></h4></div>
        <div class="card-body">
            <form action="/emprestimos" method="POST">
                @csrf
                <div class="form-group">
                    <label for="material_id"><b>Código</b></label>
                    <input type="text" class="form-control" name="material_id" value="{{ old('material_id', $emprestimo->material_id) }}">   
                </div>
                <div class="row">
                    <input type="text" class="form-control" name="username" hidden value="">        
                    <div class="col-sm form-group">
                        <label for="visitante_id"><b>Visitante</b></label> 
                        <select class="form-control" name="visitante_id">
                            <option value="" selected="">- Selecione -</option>
                            @foreach ($emprestimo->visitantesOptions() as $option)
                                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                                @if (old('tipo') == '' and isset($emprestimo->tipo))
                                <option value="{{$option->id ?? ''}}" {{ ( $emprestimo->visitante_id == $option->id) ? 'selected' : ''}}>
                                    {{$option->nome ?? ''}}
                                </option>
                                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                                @else
                                <option value="{{$option->id ?? ''}}" {{ ( old('visitante_id') == $option->id) ? 'selected' : ''}}>
                                    {{$option->nome ?? ''}}
                                </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <a href="/categorias" class="btn btn-primary float-left">Voltar</a>
                    <button type="submit" class="btn btn-success float-right">Enviar</button> 
                </div>
            </form>
        </div>
    </div>

@endsection('content')

