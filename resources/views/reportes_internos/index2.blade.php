@extends('adminlte::page')



@section('title', 'HISTORIAL DE RECETAS')

@section('content_header')
    <h1>RECETAS</h1>
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
    <th>Id</th>
    <th>Serie</th>
    <th>Rut Médico</th>
    <th>dv Médico</th>
    <th>Rut Paciente</th>
    <th>dv Paciente</th>
    <th>Dirección Paciente</th>
    <th>Ciudad</th>
    <th>Droga</th>
    <th>Cant Droga</th>
    <th>Unidad Medida</th>
    <th>FF</th>
    <th>Cantidad FF</th>
    <th>Fecha Receta</th>
    <th>Rut Adquirente</th>
    <th>dv Ad</th>
    <th>Fecha Recepción</th>
    <th>Rut QF</th>
    <th>dv QF</th>
    <th>Nombre QF</th>
    <th>Cant FF</th>
    <th>FF</th>
    <th>No Local</th>
    </tr>
    
    @foreach ($recetas as $receta)
    <tr>
    <td>{{ $receta->id }}</td>
    <td>{{ $receta->serie }}</td>
    <td>{{ $receta->tipo_preparado }}</td>
    <td>{{ $receta->medico->nombre_medico }}</td>
    <td>{{ $receta->medico->rut_medico }}</td>
    <td>{{ $receta->medico->dv_medico }}</td>
    <td>{{ $receta->fecha_recepcion }}</td>
    <td>{{ $receta->fecha_receta }}</td>
    <td>
    <a class="btn btn-success" href="{{ route('ver_index',$receta->numero_interno) }}">ver Cotizacion</a>
       
    </td>
    </tr>
    @endforeach
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
