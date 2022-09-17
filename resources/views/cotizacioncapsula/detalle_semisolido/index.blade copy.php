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
<a class="btn btn-success" href="{{ route('cotizacioncapsula.agregaMateriaPrima',$cotizacion_detalle->id) }}">Agregar Materia prima</a>
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
<th>nro_receta</th>
<th>id</th>
<th>nombre_paciente</th>
<th>nombre_doctor</th>
<th>fecha_receta</th>
</tr>
<tr>
<td>{{ $receta->numero_interno }}</td>
<td>{{ $receta->numero_interno }}</td>
<td>{{ $paciente->nombre_completo }}</td>
<td>{{ $medico->nombre_medico }}</td>
<td>{{ $receta->fecha_receta }}</td>
</tr>
</table>

<table class="table table-bordered">
    <tr>
    <th>Id</th>
    <th>Materia_id</th>
    <th>cantidad</th>
    <th>Costo</th>
    <th>subtotal</th>
    
    <th width="280px">Accion</th>
    </tr>
    <?php
    $resultado=0;
    ?>
    @foreach ($preparados as $preparado)
    
    <tr>
    <td>{{ $preparado->id }}</td>
    <td>{{ $preparado->materia_prima_id }}</td>
    <td>{{ $preparado->cantidad_materia_prima }}</td>
    <td>{{ $preparado->costo_materia_prima }}</td>
    <td>{{($preparado->cantidad_materia_prima)*($preparado->costo_materia_prima)}}</td>
    <?php
    $resultado= $resultado+($preparado->cantidad_materia_prima*$preparado->costo_materia_prima);
    ?>
    <td>
<form action="{{ route('receta.preparadocapsula.destroyMateriaPrima',['preparado_id' => $preparado,'receta_id' => $receta]) }}" method="Post">
    <!-- <form action='{{ url("/receta/indexpreparadocapsula/{$preparado->id}/{$receta->id}") }}' method="Post">
 -->
 
 <a class="btn btn-primary" href="{{ route('receta.editMateriaPrima',['preparado_id' => $preparado,'receta_id' => $receta]) }}">Edit</a>

 @csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Delete</button>
</form>
    </td>
    </tr>
    @endforeach
    
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>valor capsula</td>
    <td>50</td>
    <td>
    </td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>subtotal por capsula</td>
    <td>{{$resultado+50}}</td>
    <td>
    </td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>total capsulas</td>
    <td>{{$resultado+50}}</td>
    <td>
    </td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td>total</td>
    <td>{{($resultado+50)*($receta->cantidad_dias*$receta->posologia_diaria)}}</td>
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