@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><b>Código de Barras</b></div>
        <div class="card-body">
            <form action="categorias/barcodes" method="POST">
                @csrf
                <div class="row form-group">
                    <div class="col-sm">
                        <label>Categoria:</label>
                        <select multiple class="form-control" name="categoria_id[]">
                            <option value="" selected="">- Selecione -</option>
                            @foreach ($categorias as $option)
                                <option value="{{$option->id ?? ''}}" {{ ( old('categoria_id') == $option->id) ? 'selected' : ''}}>
                                    {{$option->nome ?? ''}}
                                </option>
                            @endforeach
                        </select>
                    </div>                
                </div>
                <div class="form-group">
                    <label>Formatação do Código de Barras:</label>
                    <select class="form-control" name="formatacao">
                        <option value="6" selected>Menor: 6 colunas, apenas com o cógido do material</option>
                        <option value="3">Maior: 3 colunas, com a descrição e o cógigo do material</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-sm">
                        <button type="submit" class="btn btn-success">Enviar</button> 
                        <a href="home" class="btn btn-primary ml-1">Voltar</a>
                    </div> 
                </div> 
            </form>
        </div>
    </div>

@endsection('content')

