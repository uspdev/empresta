
<div class="form-group">
    <label for="nome"><b>Nome</b></label>
    <input type="text" class="form-control" name="nome" value="{{ old('nome', $visitante->nome) }}">   
</div>
<div class="form-group">
    <label for="telefone"><b>Telefone</b></label>
    <input type="text" class="form-control" name="telefone" value="{{ old('telefone', $visitante->telefone) }}">   
</div>
<div class="form-group">
    <label for="email"><b>E-mail</b></label>
    <input type="text" class="form-control" name="email" value="{{ old('email', $visitante->email) }}">   
</div>
<div class="form-group">
    <a href="/categorias" class="btn btn-primary float-left">Voltar</a>
    <button type="submit" class="btn btn-success float-right">Enviar</button> 
</div> 
