@extends('adminlte::page')

@section('title', 'HISTORIAL DE RECETAS')

@section('content_header')
    <h1>HISTORIAL DE RECETAS</h1>
@stop

@section('content')
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-right mb-2">
<a class="btn btn-success" href="{{ route('cotizacioncapsula.create',$persona->id) }}"> Crear Cotización</a>
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
<th>S.No página</th>
<th>Rut</th>
<th>dv</th>
<th>Nombre completo</th>
<th>Teléfono</th>
<th>Dirección</th>
<th>Email</th>
</tr>
<tr>
<td>{{ $persona->id }}</td>
<td>{{ $persona->rut }}</td>
<td>{{ $persona->dv }}</td>
<td>{{ $persona->nombre_completo }}</td>
</tr>
</table>

<table class="table table-bordered">
    <tr>
    <th>Id</th>
    <th>Número interno</th>
    <th>Tipo de preparado</th>
    <th>Médico</th>
    <th width="280px">Acción</th>
    </tr>
    
    @foreach ($cotizaciones as $cotizacion)
    <tr>
    <td>{{ $cotizacion_detalle->id }}</td>
    <td>{{ $cotizacion_detalle->persona_id }}</td>
    <td>{{ $cotizacion_detalle->cantidad_capsulas }}</td>
    <td>{{ $cotizacion_detalle->tipo_cotizacion }}</td>
    <td>
    
<a class="btn btn-primary" href="{{ route('cotizacioncapsula.edit',$cotizacion->id) }}">Editar</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>    
       
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
