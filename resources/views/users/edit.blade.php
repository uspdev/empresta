@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><b>Edição de Usuário</b></div>
        <div class="card-body">
            <form action="/users/{{$user->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('users.form')
            </form>
        </div>
    </div>

@endsection('content')

