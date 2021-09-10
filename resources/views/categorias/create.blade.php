@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><b>Nova Categoria</b></div>
        <div class="card-body">
            <form action="/categorias" method="POST">
                @csrf
                @include('categorias.form')
            </form>
        </div>
    </div>

@endsection('content')

