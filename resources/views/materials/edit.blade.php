@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><b>Edição de Material</b></div>
        <div class="card-body">
            <form action="materials/{{$material->id}}" method="POST">
                @csrf
                @method('PATCH')
                @include('materials.form')
            </form>
        </div>
    </div>

@endsection('content')

@section('javascripts_bottom')
    @include('materials.partials.prazo-de-devolucao-js')
@endsection