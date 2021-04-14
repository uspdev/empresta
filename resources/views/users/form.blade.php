<div class="form-group">
    <label for="name"><b>Nome</b></label>
    <input type="text" class="form-control" name="name" placeholder="Nome Completo" value="{{ old('name', $user->name) }}">   
</div>
<div class="form-group">
    <label for="username"><b>Login</b></label>
    <input type="text" class="form-control" name="username" placeholder="Login" value="{{ old('username', $user->username) }}">   
</div>
<div class="form-group">
    <label for="password"><b>Senha</b></label>
    <input type="text" class="form-control" name="password" placeholder="Senha" value="{{ old('password', $user->password) }}">   
</div>
<div class="form-group">
    <label for="tipo"><b>Tipo</b></label>
    <div class="form-check">
    <input class="form-check-input" type="radio" name="tipo" id="admin" value="Administrador" checked>
    <label class="form-check-label" for="admin">
        Administrador do Sistema
    </label>
    </div>
    <div class="form-check">
    <input class="form-check-input" type="radio" name="tipo" id="balcao" value="Balcão">
    <label class="form-check-label" for="balcao">
        Balcão
    </label>
    </div>
</div>
<div class="form-group">
    <a href="/users" class="btn btn-primary">Voltar</a>
    <button type="submit" class="btn btn-success float-right">Enviar</button> 
</div> 
