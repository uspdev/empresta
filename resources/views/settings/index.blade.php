@extends('laravel-usp-theme::master')

@section('content')
    <div class="card">
        <div class="card-header">
            <b>Configurações</b>
        </div>
        <div class="card-body">
                <div class="list-group list-group-flush">
                    <a class="list-group-item config-item rounded"  href="{{route('cursos_hab.index')}}">
                        <div class="w-100 d-inline-flex justify-content-between align-items-center">
                            Cursos e Habilitações
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>
                </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .config-item{
            color: inherit;
        }
        .config-item:hover{
            background-color: rgba(207, 229, 255, 0.452);
        }
    </style>
@endsection