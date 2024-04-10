<form action="emprestimos/devolver" method="POST">
  @csrf
  <input type="hidden" class="form-control" name="material_id" value="{{ $emprestimo->material->codigo }}">
  <div>
    <button type="submit" class="btn btn-success float-left devolver" title="Devolver"><i class="fas fa-undo"></i></button>
  </div>
</form>

@once
  @section('javascripts_bottom')
    <script>
      $(document).ready(function() {
        $('.devolver').on('click', function(e) {
          if (!confirm('Tem certeza que quer registrar devolução?')) {
            e.preventDefault();
          }
        })

        const table = new DataTable('#itens-emprestados', {
          order: [[3, 'desc']]
        });

        $('#com_prazo').change(function(){
          if($(this).is(':checked'))
            table.column(4).search('dias').draw();
          else
            table.column(4).search('').draw();
        });
      })
    </script>
  @endsection
@endonce
