@extends('adminlte::page')

@section('title', 'HISTORIAL DE RECETAS')

@section('content_header')
    <h1>HISTORIAL DE RECETAS</h1>
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
<th>S.No pagina</th>
<th>rut</th>
<th>dv</th>
<th>nombre_completo</th>
<th>telefono</th>
<th>direccion</th>
<th>email</th>
</tr>
<tr>
<td>{{ $paciente->id }}</td>
<td>{{ $paciente->rut }}</td>
<td>{{ $paciente->dv }}</td>
<td>{{ $paciente->nombre_completo }}</td>
<td>{{ $paciente->telefono }}</td>
<td>{{ $paciente->direccion }}</td>
<td>{{ $paciente->email }}</td>
</tr>
</table>

<table class="table table-bordered">
    <tr>
    <th>Id</th>
    <th>Número interno</th>
    <th>Tipo de preparado</th>
    <th>Médico</th>
    <th>Fecha Recepción</th>
    <th>Fecha Receta</th>
    <th width="280px">Accion</th>
    </tr>
    
    @foreach ($recetas as $receta)
    <tr>
    <td>{{ $receta->id }}</td>
    <td>{{ $receta->numero_interno }}</td>
    <td>{{ $receta->tipo_preparado }}</td>
    <td>{{ $receta->medico->nombre_medico }}</td>
    <?php
    $newDate = date("d-m-Y", strtotime($receta->fecha_recepcion));
    $newDate2 = date("d-m-Y", strtotime($receta->fecha_receta));
    ?>
    <td>{{ $newDate }}</td>
    <td>{{ $newDate2 }}</td>
    <td>
    <a class="btn btn-success" href="{{ route('ver_index',$receta->numero_interno) }}">ver Cotizacion</a>
    <a class="btn btn-primary" href="{{ route('receta.edit',$receta->id) }}">Editar receta</a>  
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
