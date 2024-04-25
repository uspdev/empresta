@extends('errors::minimal')

@section('title', __('Sem Permissão'))
@section('code', '403')
@section('message', __('Você tentou acessar um recurso não autorizado.'))
