
@section('javascripts_bottom')
    <script>
        $(document).ready(function(){
            $('.curso_hab').select2({
                theme: 'bootstrap4',
                placeholder: "Selecionar curso e habilitação",
                language: 'pt-BR'
            });

            $('.departamento_ensino').select2({
                theme: 'bootstrap4',
                placeholder: "Selecionar departamento de ensino",
                language: 'pt-BR'
            });
        });

        // coloca o focus no select2
        // https://stackoverflow.com/questions/25882999/set-focus-to-search-text-field-when-we-click-on-select-2-drop-down
         $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
    </script>
@endsection