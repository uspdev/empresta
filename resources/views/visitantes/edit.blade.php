@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><h4><b>Edição de Visitante</b></h4></div>
        <div class="card-body">
            <form action="/visitantes/{{$visitante->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('visitantes.form')
            </form>
        </div>
    </div>

@endsection('content')

