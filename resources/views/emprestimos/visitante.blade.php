@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><b>Novo Empréstimo Visitante</b></div>
        <div class="card-body">
            <form action="emprestimos" method="POST">
                @csrf
                <div class="form-group">
                    <label for="material_id"><b>Código</b></label>
                    <input type="text" class="form-control" name="material_id" value="{{ old('material_id') }}" required autofocus>   
                </div>
                <div class="row">
                    <input type="text" class="form-control" name="username" hidden value="">        
                    <div class="col-sm form-group">
                        <label for="visitante_id"><b>Visitante</b></label> 
                        <select class="form-control visitante-select" name="visitante_id" required>
                            <option value="" selected="">- Selecione -</option>
                            @foreach ($emprestimo->visitantesOptions() as $option)
                                <option value="{{$option->id ?? ''}}" {{ ( old('visitante_id') == $option->id) ? 'selected' : ''}}>
                                    {{$option->nome ?? ''}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Enviar</button> 
                    <a href="{{route('home')}}" class="btn btn-primary ml-1">Voltar</a>
                </div>
            </form>
        </div>
    </div>

@endsection('content')


@section('javascripts_bottom')
    <script>

        $(document).ready(function() {
          /******************************************************* 
          * Código substituído pelo atributo 'autofocus' do html5
          * ******************************************************
            // https://stackoverflow.com/questions/277544/how-to-set-the-focus-to-the-first-input-element-in-an-html-form-independent-from
            // Foco no primeiro input da página
            //$('form:first *:input[type!=hidden]:first').focus();

           ********************************************************/

            let visitante_select = $('.visitante-select');
            visitante_select.select2({
                theme: 'bootstrap4',
                width: '100%'
            });
        });

        // coloca o focus no select2
        // https://stackoverflow.com/questions/25882999/set-focus-to-search-text-field-when-we-click-on-select-2-drop-down
         $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });


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
