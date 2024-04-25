@extends('laravel-usp-theme::master')

@section('content')
    <div class="alert alert-danger">
        <h5 class="alert-heading">@yield('code') | @yield('title')</h5>
        <hr>
        <p>@yield('message')</p>
    </div>
@endsection

