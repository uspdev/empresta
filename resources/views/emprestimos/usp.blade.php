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
                    <div class="col-sm form-group">
                        <label for="codpes"><b>Número USP</b></label> 
                        <input type="text" class="form-control" name="codpes" value="{{ old('codpes', $emprestimo->codpes) }}">        
                    </div>
                    <input type="text" class="form-control" name="visitante_id" hidden value="">   
                </div>
                <div class="form-group">
                    <a href="/categorias" class="btn btn-primary float-left">Voltar</a>
                    <button type="submit" class="btn btn-success float-right">Enviar</button> 
                </div> 
            </form>
        </div>
    </div>

@endsection('content')

