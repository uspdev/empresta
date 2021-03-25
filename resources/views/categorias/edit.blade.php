@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><h4><b>Edição de Categoria</b></h4></div>
        <div class="card-body">
            <form action="/categorias/{{$categoria->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('categorias.form')
            </form>
        </div>
    </div>

@endsection('content')

