@extends('adminlte::page')



@section('title', 'HISTORIAL DE RECETAS')

@section('content_header')
    <h1>REPORTES ISP REPORTES MATERIAS PRIMAS</h1>
@stop

@section('content')
<div class="container mt-2">
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<form action="{{ route('reportesMp.index2') }}" method="get">
<table class="table table-bordered">
    <tr>
    <th>opcion 1</th>
    <th>Elija Materia Prima Controlada</th>
    <th>Fecha Inicial </th>
    <th>Fecha Final</th>
    </tr>
    <tr>
    <td>LIBRO MAT PRIMAS CONTROLADAS</td>
    <td>
    <div class="form-group">
    <label for="materia_prima_id"></label>
    <select class="form-control" name="materia_prima_id">
    <option selected disabled>Seleccionar</option>
    @foreach ($materia_primas as $materia_prima)
    <option value="{{ $materia_prima->id}}">{{ $materia_prima->nombre_mp }}</option>
    @endforeach
    </select>
    </div>
    </td>
    <td>
    <div class="form-group">
    <label for="fecha_inicial"></label>
    <input type="date" class="form-control" id="fecha_inicial"  name="fecha_inicial" placeholder="Ingresa fecha_inicial"   value="" >
    </div>
</td>
<td>
    <div class="form-group">
    <label for="fecha_inicial"></label>
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
