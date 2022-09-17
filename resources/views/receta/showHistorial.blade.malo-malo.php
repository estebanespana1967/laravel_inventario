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
<a class="btn btn-success" href="{{ route('receta.create',$paciente->id) }}"> Crear receta</a>
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
<th>S.No pagina showHistorial</th>
<th>rut</th>
<th>dv</th>
<th>nombre_completo</th>
<th>telefono</th>
<th>direccion</th>
<th>email</th>
</tr>
<tr>
<td>{{ $paciente->id }}</td>
<td>{{ $paciente->rut }}</td>
<td>{{ $paciente->dv }}</td>
<td>{{ $paciente->nombre_completo }}</td>
<td>{{ $paciente->telefono }}</td>
<td>{{ $paciente->direccion }}</td>
<td>{{ $paciente->email }}</td>
</tr>
</table>

@stop

<!------- ESTO ESTA DE MAS
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
-------------->

<!-------ESTO ES NUEVO------------->

<table class="table table-bordered">
<tr>
<th>S.No</th>
<th>rut</th>
<th>dv</th>
<th>nombre_completo</th>
<th>telefono</th>
<th>direccion</th>
<th>email</th>
<th width="280px">Accion</th>
</tr>

@foreach ($recetas as $receta)
<tr>
<td>{{ $receta->id }}</td>
<td>{{ $receta->numero_interno }}</td>
<td>{{ $receta->tipo_preparado }}</td>
<td>{{ $receta->paciente_id }}</td>
<td>{{ $receta->doctor_id }}</td>
<td>

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
