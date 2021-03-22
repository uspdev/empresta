@extends('laravel-usp-theme::master')


@section('content')
    
    <h1>{{ $categoria->nome }} </h1>

    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Tipo</th>
                <th>Ativo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        for categoria->materiais()
            <tr>
                <td> material.codigo </td>
                <td> material.tipo </td>
                <td> material.ativo  'Sim'  'Não' </td>
                <td>
                    <a href="materiais/material_id"><span class="oi oi-eye"></span></a>
                    <a href="materiais/material_id/edit"><span class="oi oi-pencil"></span></a>
                </td>
            </tr>
        else
            <tr>
                <td colspan="4">no records found</td>
            </tr>
        endforr
        </tbody>
    </table>

@endsection('content')
