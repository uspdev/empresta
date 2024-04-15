<div class="form-group">
    <label for="nome"><b>Nome</b></label>
    <input type="text" class="form-control" name="nome" placeholder="Nome da Categoria" value="{{ old('nome', $categoria->nome) }}">   

    <br>
    <label><b>Vínculos Permitidos</b></label>
    <select name="vinculos_permitidos[]" class="form-control" multiple="multiple" id="vinculos_permitidos">
        @foreach ($vinculos as $vinculo)
            <option value="{{$vinculo->id}}" {{in_array($vinculo->id, $vinculos_permitidos) ? 'selected' : ''}}>{{$vinculo->nome}}</option>
        @endforeach
    </select>

    <br>
    <label><b>Setores e Departamentos de Ensino Permitidos</b></label>
    <select name="setores_permitidos[]" class="form-control" multiple="multiple" id="setores_permitidos">
        @foreach ($setores as $setor)
            @php $siglaSetor = explode('-', $setor['nomabvset'])[0]; @endphp
            <option value='{"codset": {{$setor['codset']}}, "nomabvset": "{{$siglaSetor}}", "nomset": "{{$setor['nomset']}}"}' {{in_array($setor['codset'], $setores_permitidos) ? 'selected' : ''}}>{{$setor['nomset']}} - {{$siglaSetor}}</option>
        @endforeach
    </select>

    <br>
    <div class="form-group">
        <label><b>Enviar e-mail?</b></label>
        <div class="form-check">
            <input value="1" class="form-check-input" type="radio" name="enviar_email" id="email_sim" @checked($categoria->enviar_email)>
            <label for="email_sim">Sim</label>
        </div>
        <div class="form-check">
            <input value="0" class="form-check-input" type="radio" name="enviar_email" id="email_nao" @checked(!$categoria->enviar_email)>
            <label for="email_nao">Não</label>
        </div>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button> 
    <a href="categorias" class="btn btn-primary ml-1">Voltar</a>
</div> 
