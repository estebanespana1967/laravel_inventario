@extends('adminlte::page')

@section('title', 'ETIQUETA')

@section('content_header')
@stop

@section('content')

<div class="container mt-2" id="eti1">
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif

<div class="row">
<div class="col-6"></div>
<div class="col-3">
<p>FF: @if($cotizacion->tipo_cotizacion==1)
  Capsula
  @else
  {{$cotizacion->base_crema[0]->nombre_base_crema}}
  @endif </p>

  <p>
  @if($cotizacion->tipo_cotizacion==1)
  @foreach ($cotizacion->materia_primas as $coti)
    {{ $coti->nombre_mp }}
    {{ $coti->pivot->cantidad_materia_prima }} MG,
@endforeach
@else
  
@foreach ($cotizacion->materia_primas as $coti)
    {{ $coti->nombre_mp }}
    {{ $coti->pivot->cantidad_materia_prima }} %,
@endforeach
@endif

  </p>
  <P>CSP {{ $cotizacion->cantidad_capsulas }} 
  @if($cotizacion->tipo_cotizacion==1)
  CAPS
  @else
  GRS
  @endif </p>
  </P>
<p>
  DOSIS: {{$receta[0]->posologia_diaria}} AL DIA
</p>
</div>

<div class="col-3">
<p>Doctor: {{$receta[0]->medico->nombre_medico}}</p>
<p>Paciente: {{$receta[0]->paciente->nombre_completo}}</p>
<?php

$fecha_elaboracion= date("d/m/Y", strtotime($cotizacion->fecha_elaboracion));
$fecha_vencimiento= date("d/m/Y", strtotime($cotizacion->fecha_vencimiento));

?>

<P>fecha Elab.{{ $fecha_elaboracion }}</P>
<P>fecha Venci.{{ $fecha_vencimiento }}</P>


</div>

</div>
<div class="row">
  <div class="col-6"></div>
<div class="col-6">
  <p>Mantener Fuera del alcance de los niños y conservar en lugar fresco y seco</p>
  <p>Nota: Eliminar este producto despues fecha vencimiento</p>
   <p> Resolucion RF XIII 05/20 1A,1B, y 2C Farmavida, Recoleta 5418, Huechuraba</p>
</div>
</div>
</div>
<button type="button" onclick="javascript:imprSelec('eti1');">Imprimir</button>



@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  
     function imprSelec(nombre) {
    var elem = document.getElementById('eti1');
    var ficha = document.getElementById(nombre);
	  var ventimp = window.open(' ', 'popimpr');
	  ventimp.document.write( ficha.innerHTML );
	  ventimp.document.close();
	  ventimp.print( );
	  ventimp.close();
	}
  
        function changeColor(newColor) {
   var elem = document.getElementById('para');
   elem.style.color = newColor;
}
</script>

@stop