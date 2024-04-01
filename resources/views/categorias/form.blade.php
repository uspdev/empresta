<div class="form-group">
    <label for="nome"><b>Nome</b></label>
    <input type="text" class="form-control" name="nome" placeholder="Nome da Categoria" value="{{ old('nome', $categoria->nome) }}">   

    <br>
    <label><b>Vínculos Permitidos</b></label>
    <select name="vinculos_permitidos[]" class="form-control" multiple="multiple" id="vinculos_permitidos">
        @foreach ($vinculos as $vinculo)
            <option value="{{$vinculo->permission}}" {{in_array($vinculo->permission, $vinculos_permitidos) ? 'selected' : ''}}>{{$vinculo->nome}}</option>
        @endforeach
    </select>

    <br>
    <label><b>Departamentos de Ensino Permitidos</b></label>
    <select name="departamentos_permitidos[]" class="form-control" multiple="multiple" id="departamentos_permitidos">
        @foreach ($departamentos as $departamento)
            <option value="{{$departamento->id}}" {{in_array($departamento->id, $departamentos_permitidos) ? 'selected' : ''}}>{{$departamento->nomabvset}}</option>
        @endforeach
    </select>

    <br>
    <label><b>Setores Permitidos</b> (Somente válido para os vínculos de Docente, Servidor e Estagiário)</label>
    <select name="setores_permitidos[]" class="form-control" multiple="multiple" id="setores_permitidos">
        @foreach ($setores as $setor)
            @php $siglaSetor = explode('-', $setor['nomabvset'])[0]; @endphp
            <option value='{"codset": {{$setor['codset']}}, "nomabvset": "{{$siglaSetor}}", "nomset": "{{$setor['nomset']}}"}' {{in_array($setor['codset'], $setores_permitidos) ? 'selected' : ''}}>{{$setor['nomset']}} - {{$siglaSetor}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <a href="categorias" class="btn btn-primary float-right">Voltar</a>
    <button type="submit" class="btn btn-success float-left">Enviar</button> 
</div> 
