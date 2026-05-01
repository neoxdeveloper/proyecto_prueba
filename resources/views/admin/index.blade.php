@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
@if($empresa && $empresa->nombre_empresa)
    <h1><b>Bienvenido {{ $empresa->nombre_empresa }}</b></h1>
    <hr>

@else
    <h1><b>Bienvenido</b> (Empresa no encontrada)</h1>
@endif
@stop

@section('content')
<p></p>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop