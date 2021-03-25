
<div class="form-group">
    <label for="material_id"><b>Código</b></label>
    <input type="text" class="form-control" name="material_id" value="{{ old('material_id', $emprestimo->material_id) }}">   
</div>
<div class="row">
    <div class="col-sm form-group">
        <label for="codpes"><b>Número USP</b></label> 
        <input type="text" class="form-control" name="codpes" value="{{ old('codpes', $emprestimo->codpes) }}">        
    </div>
    <div class="col-auto form-group"><br><br>ou</div>
    <div class="col-sm form-group">
        <label for="visitante_id"><b>Visitante</b></label> 
        <select class="form-control" name="visitante_id">
            <option value="" selected="">- Selecione -</option>
            @foreach ($emprestimo->visitantesOptions() as $option)
                {{-- 1. Situação em que não houve tentativa de submissão e é uma edição --}}
                @if (old('tipo') == '' and isset($emprestimo->tipo))
                <option value="{{$option->id ?? ''}}" {{ ( $emprestimo->visitante_id == $option->id) ? 'selected' : ''}}>
                    {{$option->nome ?? ''}}
                </option>
                {{-- 2. Situação em que houve tentativa de submissão, o valor de old prevalece --}}
                @else
                <option value="{{$option->id ?? ''}}" {{ ( old('visitante_id') == $option->id) ? 'selected' : ''}}>
                    {{$option->nome ?? ''}}
                </option>
                @endif
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <a href="/categorias" class="btn btn-primary float-left">Voltar</a>
    <button type="submit" class="btn btn-success float-right">Enviar</button> 
</div> 
