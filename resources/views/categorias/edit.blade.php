@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><b>Edição de Categoria</b></div>
        <div class="card-body">
            <form action="/categorias/{{$categoria->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('categorias.form')
            </form>
        </div>
    </div>

@endsection('content')

