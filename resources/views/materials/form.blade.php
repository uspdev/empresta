
<div class="form-group">
    <label for="codigo"><b>Código</b></label>
    <input type="text" class="form-control" name="codigo" value="{{ old('codigo', $material->codigo) }}" minlength="3" required>   
</div>
<div class="form-group">
    <label for="categoria_id"><b>Tipo</b></label> 
    <select class="form-control" name="categoria_id" required>
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
    <input type="text" class="form-control" name="descricao" value="{{ old('descricao', $material->descricao) }}" required>   
</div>
<div class="form-group">
    <label for="descricao"><b>Ativo?</b></label>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="ativo" id="sim" value="1" @if($material->ativo == 1 or Request()->ativo == 1) checked @endif>
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
    <label><b>Prazo de devolucao?</b></label>
    <div class="form-check">
        <input value="1" class="form-check-input" type="radio" name="devolucao" id="devolucao-sim" @checked($material->devolucao)>
        <label for="devolucao-sim">Sim</label>
    </div>
    <div class="form-check">
        <input value="0" class="form-check-input" type="radio" name="devolucao" id="devolucao-nao" @checked(!$material->devolucao)>
        <label for="devolucao-nao">Não</label>
    </div>
</div>
<div @if($material->devolucao) class="form-group" @else  class="form-group d-none" @endif id="prazo-devolucao">
    <label><b>Prazo de devolucao</b></label>
    <input name="prazo" min="2" type="number" placeholder="Mínimo de 2 dias de prazo" class="form-control" value="{{$material->prazo}}">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button> 
    <a href="categorias" class="btn btn-primary ml-1">Voltar</a>
</div> 
