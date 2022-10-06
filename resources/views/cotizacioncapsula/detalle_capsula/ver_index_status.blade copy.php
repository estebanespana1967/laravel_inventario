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
      <form action="{{ route('orden_trabajo.updateLoteSerie',$cotizacion_detalle->id)  }}" method="POST">
      @csrf
      @method('PUT')
                
      <input type="hidden" name="id_cotizacion" id="id_cotizacion" value="{{$cotizacion_detalle->id}}">

     @foreach ($cotizacion_detalle->materia_primas as $cotizacion)
    
    <tr>
    <td>{{ $cotizacion->pivot->id }}</td>
    <td>{{ $cotizacion->nombre_mp }}</td>
    <td>{{ $cotizacion->pivot->cantidad_materia_prima }}</td>
    <td>{{ $cotizacion->id }}</td>
    <td>


<select name="detalle_{{$cotizacion->id}}" id="">
@foreach($detalle_entrada as $detalle)

<option value="{{$detalle->id}}">Vencto:{{$detalle->fecha_vencimiento}} Lote: {{$detalle->lote}} Serie:{{$detalle->serie}} </option>

@endforeach
</select>

</td>
</tr>
    @endforeach
<tr>
<td></td>
<td></td>
<td></td>
<td></td>

<td><button type="submit" class="btn btn-primary">Actualizar</button>
</td>

</tr>
</form>    

</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop