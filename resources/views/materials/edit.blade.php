@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><h4><b>Edição de Material</b></h4></div>
        <div class="card-body">
            <form action="/materials/{{$material->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('materials.form')
            </form>
        </div>
    </div>

@endsection('content')

