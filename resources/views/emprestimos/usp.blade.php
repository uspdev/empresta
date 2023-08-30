@extends('laravel-usp-theme::master')

@section('content')

    @include('flash')
    <div class="card">
        <div class="card-header"><b>Novo Empréstimo USP</b></div>
        <div class="card-body">
            <form action="emprestimos" method="POST">
                @csrf
                <div class="form-group">
                    <label for="material_id"><b>Código</b></label>
                    <input type="text" class="form-control" name="material_id" value="{{ old('material_id') }}" required autofocus>   
                </div>
                <div class="form-group">
                    <label for="username"><b>Número USP</b></label> 
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" required>        
                    <input type="text" class="form-control" name="visitante_id" hidden value="">   
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success float-left">Enviar</button> 
                </div> 
            </form>
        </div>
    </div>

@endsection('content')

@section('javascripts_bottom')
    <script>

        /******************************************************* 
        * Código substituído pelo atributo 'autofocus' do html5
        * ******************************************************
        // https://stackoverflow.com/questions/277544/how-to-set-the-focus-to-the-first-input-element-in-an-html-form-independent-from
        // Foco no primeiro input da página
        $(document).ready(function() {
            $('form:first *:input[type!=hidden]:first').focus();
        });
        ********************************************************/

        // jQuery plugin to prevent double submission of forms
        // https://stackoverflow.com/questions/2830542/prevent-double-submission-of-forms-in-jquery
        jQuery.fn.preventDoubleSubmission = function() {
        $(this).on('submit',function(e){
            var $form = $(this);

            if ($form.data('submitted') === true) {
                // Previously submitted - don't submit again
                e.preventDefault();
            } else {
                // Mark it so that the next submit can be ignored
                $form.data('submitted', true);
            }
        });

            // Keep chainability
            return this;
        };
        $('form').preventDoubleSubmission();

        // Desabilitando enter por conta do leitor de código de barras
        jQuery.fn.disableEnter = function() {
            $('form').keypress(function(e) {
            //Enter key
            if (e.which == 13) {
                return false;
            }
            });
        };

        if({{!config('empresta.habilitarEnter')}})
            $('form').disableEnter();
  
    </script>
@endsection
