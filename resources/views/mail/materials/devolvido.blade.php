<x-mail::message>
# Material Devolvido

Código: {{$material->codigo}} <br>
Descrição: {{$material->descricao}} <br>
Data de empréstimo: {{date('d/m/Y', strtotime($data_emprestimo))}} <br>
@if ($material->devolucao)
@php
    $atrasado = 0;
    if ($material->dias_da_semana ) 
        $prazo_devolucao = date('d/m/Y', strtotime($data_emprestimo . ' +' . $material->prazo . ' weekdays'));
    else 
        $prazo_devolucao = date('d/m/Y', strtotime($data_emprestimo . ' +' . $material->prazo . ' days'));

    if($data_devolucao > $prazo_devolucao) $atrasado = 1;
@endphp
Prazo de devolução: <b @if($atrasado) style="color: red" @endif>{{$prazo_devolucao}}</b><br>
@endif
Data de devolução: {{date('d/m/Y', strtotime($data_devolucao))}} <br>

</x-mail::message>