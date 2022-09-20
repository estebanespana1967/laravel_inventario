@extends('adminlte::page')



@section('title', 'HISTORIAL DE RECETAS')

@section('content_header')
    <h1>REPORTES RECETAS</h1>
@stop

@section('content')
<div class="container mt-2">
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
    <th>Opcion 1</th>
    <th>Libro por materia controlada</th>
    <th>Fecha ini</th>
    <th>Fecha final</th>
    </tr>
    <tr>
    <td>LIBRO MAT PRIMAS CONTROLADAS</td>
    <td>
    <div class="form-group">
    <label for="materia_prima_id">Materia prima</label>
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
       
</td>
    </tr>
  
</table>

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
</td>
    </tr>
</table>

<table class="table table-bordered">
    <tr>
    <th>opcion 3</th>
    <th></th>
    <th>Fecha ini</th>
    <th>Fecha final</th>
    </tr>
    <tr>
    <td>LIBRO DE PRODUCCION</td>
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
