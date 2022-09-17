@extends('adminlte::page')



@section('title', 'LIBRO DE CONFECCION')

@section('content_header')
    <h1>REPORTES ISP LIBRO CONFECCION - PRODUCCION</h1>
@stop

@section('content')
<div class="container mt-2">
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<form action="{{ route('reportesLc.index2') }}" method="get">

<table class="table table-bordered">
    <tr>
    <th>opcion 2</th>
    <th></th>
    <th>Fecha ini</th>
    <th>Fecha final</th>
    </tr>
    <tr>
    <td>LIBRO DE RECETAS</td>
    <td>
    </td>
    <td>
    <div class="form-group">
    <label for="fecha_inicial">Fecha Inicial</label>
    <input type="date" class="form-control" id="fecha_inicial"  name="fecha_inicial" placeholder="Ingresa fecha_recepcion"   value="" >
    </div>
</td>
<td>
    <div class="form-group">
    <label for="fecha_inicial">Fecha Inicial</label>
    <input type="date" class="form-control" id="fecha_inicial"  name="fecha_inicial" placeholder="Ingresa fecha_recepcion"   value="" >
    </div>
</td>
<td>

<button type="submit" class="btn btn-primary float-right">Ver informe</button>
</td>
  
</table>
</form>
<td>
</td>
    </tr>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
