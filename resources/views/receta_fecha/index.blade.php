@extends('adminlte::page')



@section('title', 'RECETAS')

@section('content_header')
    <h1>REPORTE POR FECHA</h1>
@stop

@section('content')
<div class="container mt-2">
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<form action="{{ route('receta_fecha.index2') }}" method="get">
<table class="table table-bordered">
    <tr>
    <th>opcion 1</th>
    <th>Fecha Inicial </th>
    <th>Fecha Final</th>
    </tr>
    <tr>
    <td>REPORTE RECETAS</td>

    <td>
    <div class="form-group">
    <label for="fecha_inicial"></label>
    <input type="date" class="form-control" id="fecha_inicial"  name="fecha_inicial" placeholder="Ingresa fecha_inicial"   value="" >
    </div>
</td>
<td>
    <div class="form-group">
    <label for="fecha_final"></label>
    <input type="date" class="form-control" id="fecha_final"  name="fecha_final" placeholder="Ingresa fecha_final"   value="" >
    </div>
</td>
<td>

<button type="submit" class="btn btn-primary float-right">Ver informe</button>
</td>
    </tr>
  
</table>
</form>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
