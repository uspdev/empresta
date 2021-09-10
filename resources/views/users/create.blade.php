@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><b>Novo Usuário</b></div>
        <div class="card-body">
            <form action="/users" method="POST">
                @csrf
                @include('users.form')
            </form>
        </div>
    </div>

@endsection('content')

