@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><h4><b>Novo Visitante</b></h4></div>
        <div class="card-body">
            <form action="/visitantes" method="POST">
                @csrf
                @include('visitantes.form')
            </form>
        </div>
    </div>

@endsection('content')

