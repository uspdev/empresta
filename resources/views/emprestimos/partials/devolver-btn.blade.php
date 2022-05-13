<form action="emprestimos/devolver" method="POST">
  @csrf
  <input type="hidden" class="form-control" name="material_id" value="{{ $emprestimo->material->codigo }}">
  <div class="form-group">
    <button type="submit" class="btn btn-success float-left devolver" title="Devolver"><i class="fas fa-undo"></i></button>
  </div>
</form>

@once
  @section('javascripts_bottom')
    <script>
      $(document).ready(function() {
        $('.devolver').on('click', function(e) {
          if (!confirm('Tem certeza ?')) {
            e.preventDefault();
          }
        })
      })
    </script>
  @endsection
@endonce
