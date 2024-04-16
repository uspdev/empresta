<x-mail::message>
# Material Emprestado

Código: {{$material->codigo}} <br>
Descrição: {{$material->descricao}} <br>
Data de empréstimo: {{date('d/m/Y', strtotime($data_emprestimo))}} <br>
@if ($material->devolucao)
@php
    if ($material->dias_da_semana ) 
        $prazo_devolucao = date('d/m/Y', strtotime($data_emprestimo . ' +' . $material->prazo . ' weekdays'));
    else 
        $prazo_devolucao = date('d/m/Y', strtotime($data_emprestimo . ' +' . $material->prazo . ' days'));
@endphp
Prazo de devolução: <b>{{$prazo_devolucao}}</b>  
@endif

</x-mail::message>
