<script>
    $(document).ready(function() {
        $('input[type=radio][name=devolucao]').change(function(){
            if($(this).val() == 1){
                $('#prazo-devolucao').removeClass('d-none');
                $('input[type=number][name=prazo]').prop('required', true);
            }
            else{
                $('#prazo-devolucao').addClass('d-none');
                $('input[type=number][name=prazo]').prop('required', false);
            }
        });
    });
</script>