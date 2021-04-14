@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><h4><b>Código de Barras</b></h4></div>
        <div class="card-body">
            <form action="/categorias/barcodes" method="POST">
                @csrf
                <div class="form-group">
                    <div class="col-sm form-group">
                        <label for="categoria_id"><b>Filtro</b></label> 
                        <select multiple class="form-control" name="categoria_id[]">
                            <option value="" selected="">- Selecione -</option>
                            @foreach ($categorias as $option)
                                <option value="{{$option->id ?? ''}}" {{ ( old('categoria_id') == $option->id) ? 'selected' : ''}}>
                                    {{$option->nome ?? ''}}
                                </option>
                            @endforeach
                        </select>
                    </div>                </div>
                <div class="form-group">
                    <a href="/home" class="btn btn-primary float-left">Voltar</a>
                    <button type="submit" class="btn btn-success float-right">Enviar</button> 
                </div> 
            </form>
        </div>
    </div>

@endsection('content')

