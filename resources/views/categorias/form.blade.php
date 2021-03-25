<div class="form-group">
    <label for="nome"><b>Nome</b></label>
    <input type="text" class="form-control" name="nome" placeholder="Nome da Categoria" value="{{ old('nome', $categoria->nome) }}">   
</div>
<div class="form-group">
    <a href="/categorias" class="btn btn-primary float-left">Voltar</a>
    <button type="submit" class="btn btn-success float-right">Enviar</button> 
</div> 
