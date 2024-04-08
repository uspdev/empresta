@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><b>Novo Material</b></div>
        <div class="card-body">
            <form action="materials" method="POST">
                @csrf
                @include('materials.form')
            </form>
        </div>
    </div>

@endsection('content')

@section('javascripts_bottom')
<script>
    $(document).ready(function() {
        $('input[type=radio][name=devolucao]').change(function(){
            if($(this).val() == 1){
                $('#prazo-devolucao').removeClass('d-none');
            }
            else{
                $('#prazo-devolucao').addClass('d-none');
            }
        });
    });
</script>
@endsection