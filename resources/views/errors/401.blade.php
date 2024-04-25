@extends('errors::minimal')

@section('title', __('Sem Autorização'))
@section('code', '401')
@section('message', __('Você não tem autorização para realizar esta ação.'))
