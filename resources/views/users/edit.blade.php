@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><h4><b>Edição de Usuário</b></h4></div>
        <div class="card-body">
            <form action="/users/{{$user->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('users.form')
            </form>
        </div>
    </div>

@endsection('content')

