<table width="50%">
<table border="1" style="float: left;" width="50%">

<FONT SIZE="1">FF: 
  @if($cotizacion->tipo_cotizacion==1)
  Cápsula
  </font>
  @else
  {{$cotizacion->base_crema[0]->nombre_base_crema}}
  @endif 

  <p>
  @if($cotizacion->tipo_cotizacion==1)
  @foreach ($cotizacion->materia_primas as $coti)
    <FONT SIZE="1">{{ $coti->nombre_mp }}
    {{ $coti->pivot->cantidad_materia_prima }} MG<br></font>
    @endforeach
@else
@foreach ($cotizacion->materia_primas as $coti)
{{ $coti->nombre_mp }}
{{ $coti->pivot->cantidad_materia_prima }} %,
@endforeach
@endif
</p>
  <P><FONT SIZE="1">CSP {{ $cotizacion->cantidad_capsulas }} 
  @if($cotizacion->tipo_cotizacion==1)
  CAPS
  @else
  GRS
  @endif </font></p>
  </P>
<p>
<FONT SIZE="1">DOSIS: {{$receta[0]->posologia_diaria}} AL DIA</>
</p>
</table>
<table border="1" width="50%" style="float: right;">
<p><FONT SIZE="1">Dr: {{$receta[0]->medico->nombre_medico}}</font></p>
<p><FONT SIZE="1">Pac: {{$receta[0]->paciente->nombre_completo}}</font></p>
<?php

$fecha_elaboracion= date("d/m/Y", strtotime($cotizacion->fecha_elaboracion));
$fecha_vencimiento= date("d/m/Y", strtotime($cotizacion->fecha_vencimiento));

?>

<P><FONT SIZE="1">fecha Elab.{{ $fecha_elaboracion }}</font></P>
<P><FONT SIZE="1">fecha Venci.{{ $fecha_vencimiento }}</font></P>
</div>

</div>
</table>
<table border="1" >
<p><FONT SIZE="1">Mantener Fuera del alcance de los niños y conservar en lugar fresco y seco</p>
<p><FONT SIZE="1">Nota: Eliminar este producto despues fecha vencimiento</p>
<p><FONT SIZE="1"> Resolucion RF XIII 05/20 1A,1B, y 2C Farmavida, Recoleta 5418, Huechuraba</p>

</table>
</table>

