@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><h4><b>Novo Empréstimo</b></h4></div>
        <div class="card-body">
            <form action="/emprestimos" method="POST">
                @csrf
                @include('emprestimos.form')
            </form>
        </div>
    </div>

@endsection('content')

