@extends('adminlte::page')

@section('title', 'COTIZACION CAPSULAS')

@section('content_header')
    <h1>COTIZACION CAPSULAS</h1>
@stop

@section('content')
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-right mb-2">
<a class="btn btn-success" href="{{ route('cotizacioncapsula.create',$persona->id) }}">{{$persona}}.Agregar Materia prima</a>
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
<th>nombre_persona</th>
</tr>
<tr>
<td>{{ $persona->nombre_completo }}</td>
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
    @foreach ($cotizaciones as $cotizacion)
    
    <tr>
    <td>{{ $cotizacion->id }}</td>
    <td>{{ $cotizacion->materia_prima_id }}</td>
    <td>{{ $cotizacion->cantidad_materia_prima }}</td>
    <td>{{ $cotizacion->costo_materia_prima }}</td>
    <td>{{$cotizacion->cantidad_materia_prima*$cotizacion->costo_materia_prima}}</td>
    <?php
    $resultado= $resultado+($cotizacion->cantidad_materia_prima*$cotizacion->costo_materia_prima);
    ?>
    <td>
<form action="{{ route('cotizacioncapsula.destroy',['cotizacion_id' => $cotizacion,'persona_id' => $persona]) }}" method="Post">
    <!-- <form action='{{ url("/receta/indexpreparadocapsula/{$preparado->id}/{$receta->id}") }}' method="Post">
 -->
 
 <a class="btn btn-primary" href="{{ route('cotizacioncapsula.edit',['cotizacion_id' => $cotizacion,'persona_id' => $persona]) }}">Edit</a>

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