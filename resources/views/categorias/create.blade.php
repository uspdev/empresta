@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><h4><b>Nova Categoria</b></h4></div>
        <div class="card-body">
            <form action="/categorias" method="POST">
                @csrf
                @include('categorias.form')
            </form>
        </div>
    </div>

@endsection('content')

