@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><h4><b>Novo Usuário</b></h4></div>
        <div class="card-body">
            <form action="/users" method="POST">
                @csrf
                @include('users.form')
            </form>
        </div>
    </div>

@endsection('content')

