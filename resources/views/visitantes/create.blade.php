@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><b>Novo Visitante</b></div>
        <div class="card-body">
            <form action="visitantes" method="POST">
                @csrf
                @include('visitantes.form')
            </form>
        </div>
    </div>

@endsection('content')

