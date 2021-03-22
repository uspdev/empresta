@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><h4><b>Novo Material</b></h4></div>
        <div class="card-body">
            <form action="/materials" method="POST">
                @csrf
                @include('materials.form')
            </form>
        </div>
    </div>

@endsection('content')

