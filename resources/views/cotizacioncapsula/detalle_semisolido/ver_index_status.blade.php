@extends('adminlte::page')

@section('title', 'COTIZACION')

@section('content_header')
    <h1>PREPARADO COTIZACION SEMISOLIDO</h1>
@stop

@section('content')
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<table class="table table-bordered">
<tr>
<th>id_paciente</th>
<th>Nombre apellido</th>
<th>Cantidad Semisolido</th>
<th>Fecha Cotización</th>
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
    <th>Costo</th>
    <th>Subtotal</th>
    </tr>
    <?php
    $resultado=0;
?>
    @foreach ($cotizacion_detalle->materia_primas as $cotizacion)
    
    <tr>
    <td>{{ $cotizacion->pivot->id }}</td>
    <td>{{ $cotizacion->nombre_mp }}</td>
    <td>{{ $cotizacion->pivot->cantidad_materia_prima }}</td>
    <td>{{ $cotizacion->pivot->costo_materia_prima }}</td>
    <td>{{$cotizacion->pivot->cantidad_materia_prima*$cotizacion->pivot->costo_materia_prima}}</td>
    <?php
    $resultado= ($resultado+($cotizacion->pivot->cantidad_materia_prima*$cotizacion->pivot->costo_materia_prima));
    $resultado=($resultado);
    ?>
    
    </tr>
    @endforeach
    
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>SUBTOTAL MATERIA PRIMA</td>
    <td>{{ $resultado }}</td>
    <td>
    </td>
    </tr><tr>
    <td><input type="hidden" class="form-control" id="tipo_cotizacion" name="tipo_cotizacion" value="{{ $cotizacion_detalle->tipo_cotizacion}}" >
    </td>
    <td></td>
    <td></td>
    <td> BASE:{{$cotizacion_detalle->base_crema[0]->nombre_base_crema}}. Valor</td>
    <td>{{$cotizacion_detalle->base_crema[0]->costo_base_crema}}</td>
    <td>
    </td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>SUBTOTOTAL POR GRAMO</td>
    <td>{{$resultado+$cotizacion_detalle->base_crema[0]->costo_base_crema}}</td>
    <td>
    </td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>CANTIDAD TOTAL SEMISOLIDO</td>
    <td>{{ $cotizacion_detalle->cantidad_capsulas }}</td>
    <td>
    </td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Total</td>
    <?php
    $parcial= ($resultado+$cotizacion_detalle->base_crema[0]->costo_base_crema)*($cotizacion_detalle->cantidad_capsulas);
    $parcial=round($parcial*0.01)*100;
    ?>
    <td>{{ number_format($parcial, 2)}}</td>
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