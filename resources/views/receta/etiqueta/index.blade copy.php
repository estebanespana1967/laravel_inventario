@extends('adminlte::page')

@section('title', 'ETIQUETA')

@section('content_header')
@stop

@section('content')
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<table class="table table-bordered">
</table>
<a href="javascript:window.print()">Imprimir</a>

<button type="button" onclick="javascript:window.print()">Imprimir</button>
<button type="button" onclick="javascript:imprim1(imp1);">Imprimir</button>

JAVASCRIPT
<script>
function imprim1(imp1){
var printContents = document.getElementById('imp1').innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
		w.print();
		w.close();
        return true;}
</script>
<div id="imp1">
    <h2>este es un div de prueba</h2>
</div>
<div class="container">
  <div class="row">
    <div class="col" id="eti1">
     Ejemplo de etiqueta 1
    </div>
    <div class="col" id="eti2">
     Ejemplo de etiqueta 2
    </div>
  </div>
  <div class="row">
    <div class="col" id="eti3">
     Ejemplo de etiqueta 3
    </div>
    <div class="col" id="eti4">
     Ejemplo de etiqueta 4
    </div>
  </div>
</div>













<table class="table table-bordered">
    <?php
    $resultado=0;
    $cantidad_capsulas=($receta->cantidad_dias*$receta->posologia_diaria);
    $i=0;
    ?>

    @foreach ($receta->materia_primas as $preparado)
    <?php
   /* for ($a = 1; $a <= 10; $a++) {
     $A[$a] = '';
    $B[$a] = ''; 
        
    }*/

    
    $i=$i+1;
    $A[$i] = $preparado->nombre_mp;
    $B[$i] = $preparado->pivot->cantidad_materia_prima;
    $numero_receta=$preparado->pivot->id;
    $elaboracion=$receta->fecha_recepcion;
    $elabora=date("d-m-Y",strtotime($elaboracion)); 
    $venci= date("d-m-Y",strtotime($elaboracion."+ 45 days")); 
    ?>
    <tr>
    <?php
    $resultado= ($resultado+($preparado->pivot->cantidad_materia_prima*$preparado->pivot->costo_materia_prima));
    $resultado=(int)($resultado);
    
    ?>
    </td>
    </tr>
    @endforeach
    <tr>
    <td>FF: CAPSULAS..TOTAL:{{$cantidad_capsulas}} </td>
    
    <td>
    <td>N°</td>
    <td>{{ $receta->numero_interno }}</td><td>F.Elab.{{ $elabora }}</td><td>F.Venci.{{ $venci }}</td>
    </TR>
    <tr>
    <td>{{$A[1]}}</td>
    <td>{{$B[1]}} MG</td>
    <td></td>
    <td></td>
    <td>Pac</td>
    <td>{{ $paciente->nombre_completo }}</td>
    </TR>
    <tr>
    <td>{{$A[2]}}</td>
    <td>{{$B[2]}} MG</td>
    <td></td>
    <td></td>
    <td>Doc</td>
    <td>{{ $medico->nombre_medico }}</td>
    </TR>
    <tr>
    <td>{{$A[3]}}</td>
    <td>{{$B[3]}} MG</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </TR>

    <tr>
    <td>{{$A[4]}}</td>
    <td>{{$B[4]}}</td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </TR>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    
    <td></td>
    </TR>
    </table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop