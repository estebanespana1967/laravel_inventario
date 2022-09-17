
@extends('adminlte::page')

@section('title', 'IMPRIMIR PDF')

@section('content_header')
    <h1>IMPRIMIR</h1>
@stop

@section('content')
    <div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<P>IMPRIMIR PDF</P>
</div>
<div class="pull-right mb-2">
<th>Venta</th>
<a href="{{ route('imprimir.index') }}">Imprimir pdf</a>


@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop