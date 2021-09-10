@extends('laravel-usp-theme::master')

@section('content')
@include('flash')
    <div class="card">
        <div class="card-header"><b>Código de Barras</b></div>
        <div class="card-body">
            <form action="/categorias/barcodes" method="POST">
                @csrf
                <div class="row form-group">
                    <div class="col-sm">
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
                <div class="row">
                    <div class="col-sm">
                        <a href="/home" class="btn btn-primary float-left">Voltar</a>
                        <button type="submit" class="btn btn-success float-right">Enviar</button> 
                    </div> 
                </div> 
            </form>
        </div>
    </div>

@endsection('content')

