
<div class="form-group">
    <label for="codigo"><b>Código</b></label>
    <input type="text" class="form-control" name="codigo" value="{{ old('codigo', $material->codigo) }}" minlength="3">   
</div>
<div class="form-group">
    <label for="categoria_id"><b>Tipo</b></label> 
    <select class="form-control" name="categoria_id">
        <option value="" selected="">- Selecione -</option>
        @foreach ($material->categoriasOptions() as $option)
            {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
            @if (old('categoria_id') == '' and isset($material->categoria_id))
            <option value="{{$option['id'] ?? ''}}" {{ ( $material->categoria_id == $option['id']) ? 'selected' : ''}}>
                {{$option['nome'] ?? ''}}
            </option>
            {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
            @else
            <option value="{{$option['id'] ?? ''}}" {{ ( old('categoria_id') == $option['id']) ? 'selected' : ''}}>
                {{$option['nome'] ?? ''}}
            </option>
            @endif
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="descricao"><b>Descrição</b></label>
    <input type="text" class="form-control" name="descricao" value="{{ old('descricao', $material->descricao) }}">   
</div>
<div class="form-group">
    <label for="descricao"><b>Ativo?</b></label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="ativo" id="sim" value="1" @if($material->ativo == 1 or Request()->ativo == 1)) checked @endif>
        <label class="form-check-label" for="sim">
            Sim
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="ativo" id="não" value="0" @if($material->ativo != 1) checked @endif>
        <label class="form-check-label" for="não">
            Não
        </label>
    </div>   
</div>
<div class="form-group">
    <a href="categorias" class="btn btn-primary float-right">Voltar</a>
    <button type="submit" class="btn btn-success float-left">Enviar</button> 
</div> 
