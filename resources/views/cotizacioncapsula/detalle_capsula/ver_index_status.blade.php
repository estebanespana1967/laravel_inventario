@extends('adminlte::page')

@section('title', 'COTIZACION')

@section('content_header')
    <h1>ASIGNAR MATERIA PRIMA COTIZACION CAPSULA</h1>
@stop

@section('content')
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="row">
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
<tr>
<th>id_paciente</th>
<th>Nombre apellido</th>
<th>Cantidad cápsulas</th>
<th>Fecha cotización</th>
<th>Estado</th>

</tr>


<tr>
<td>{{ $paciente->id}}</td>
<td>{{ $paciente->nombre_completo }}</td>
<td>{{ $cotizacion_detalle->cantidad_capsulas }}</td>
<?php
$newDate = date("d-m-Y", strtotime($cotizacion_detalle->fecha_cotizacion));
?>
<td>{{ $newDate }}</td>
<td>{{ $cotizacion_detalle->estado }}</td>
</tr>
</table>

<table class="table table-bordered">
    <tr>
    <th>Id</th>
    <th>Materia_id</th>
    <th>cantidad</th>
    <th>materia prima en uso</th>
    
    <th width="280px">Acción</th>
    </tr>
    <?php
    $resultado=0;
?>
      
     @foreach ($cotizacion_detalle->materia_primas as $cotizacion)
    
    <tr>
    <td>{{ $cotizacion->pivot->id }}</td>
    <td>{{ $cotizacion->nombre_mp }}</td>
    <td>{{ $cotizacion->pivot->cantidad_materia_prima }}</td>
    <td>{{ $cotizacion->id }}</td>
    <td>
@foreach($detalle_entrada as $detalle)
<select name="" id="">

@if($detalle->id_materia_prima == $cotizacion->id)
<option value="{{$detalle->id}}">{{$detalle->fecha_vencimiento}}  {{$detalle->lote}} {{$detalle->serie}} </option>

@else
</select>


@endif
@endforeach
</td>
</tr>
    @endforeach
    
       
</td>
    <td>
    <div class="pull-right mb-2">
</div></td>
    </tr>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop