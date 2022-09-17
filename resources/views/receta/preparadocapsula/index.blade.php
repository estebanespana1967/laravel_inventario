@extends('adminlte::page')

@section('title', 'PREPARADO CAPSULAS')

@section('content_header')
    <h1>PREPARADO CAPSULAS</h1>
@stop

@section('content')
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-right mb-2">
<a class="btn btn-success" href="{{ route('receta.createMateriaPrima',$receta->id) }}">Agregar Materia prima</a>
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
<th>Nro Receta</th>
<th>id</th>
<th>Nombre Paciente</th>
<th>Nombre Doctor</th>
<th>Fecha Receta</th>
</tr>
<tr>
<td>{{ $receta->numero_interno }}</td>
<td>{{ $receta->id }}</td>
<td>{{ $paciente->nombre_completo }}</td>
<td>{{ $medico->nombre_medico }}</td>
<td>{{ $receta->fecha_receta }}</td>
</tr>
</table>

<table class="table table-bordered">
    <tr>
    <th>Id</th>
    <th>Materia_id</th>
    <th>Cantidad</th>
    <th>Costo</th>
    <th>Subtotal</th>
    
    <th width="280px">Accion</th>
    </tr>
    <?php
    $resultado=0;
$cantidad_capsulas=($receta->cantidad_dias*$receta->posologia_diaria);
?>
    @foreach ($receta->materia_primas as $preparado)
    
    <tr>
    <td>{{ $preparado->pivot->id }}</td>
    <td>{{ $preparado->nombre_mp }}</td>
    <td>{{ $preparado->pivot->cantidad_materia_prima }}</td>
    <td>{{ $preparado->pivot->costo_materia_prima }}</td>
    <td>{{$preparado->pivot->cantidad_materia_prima*$preparado->pivot->costo_materia_prima}}</td>
    <?php
    $resultado= ($resultado+($preparado->pivot->cantidad_materia_prima*$preparado->pivot->costo_materia_prima));
    $resultado=(int)($resultado);
    ?>
    <td>
<form action="{{ route('receta.preparadocapsula.destroyMateriaPrima',['preparado_id' => $preparado,'receta_id' => $receta]) }}" method="Post">
    <!-- <form action='{{ url("/receta/indexpreparadocapsula/{$preparado->id}/{$receta->id}") }}' method="Post">
 -->
 
 <a class="btn btn-primary" href="{{ route('receta.editMateriaPrima',['preparado_id' => $preparado,'receta_id' => $receta]) }}">Edit</a>

 @csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>
    </td>
    </tr>
    @endforeach
    
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Cantidad de cápsulas</td>
    <td>{{ $cantidad_capsulas }}</td>
    <td>
    </td>
    </tr><tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Valor cápsula</td>
    <td>50</td>
    <td>
    </td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Subtotal por cápsula</td>
    <td>{{$resultado+50}}</td>
    <td>
    </td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>Total</td>
    <?php
    $parcial= ($resultado+50)*($receta->cantidad_dias*$receta->posologia_diaria);
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