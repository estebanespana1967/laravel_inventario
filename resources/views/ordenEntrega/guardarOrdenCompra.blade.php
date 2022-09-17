@extends('adminlte::page')

@section('title', 'ORDEN DE TRABAJO')

@section('content_header')
    <h1>ORDEN DE TRABAJO</h1>
@stop

@section('content')
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-right mb-2">
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
    <th>Id</th>
    <th>Persona</th>
    <th>Fecha Recepcion</th>
    <th>Tipo de cotizacion</th>
    <th>Valor</th>
    <th>Estado</th>
    <th width="280px">Accion</th>
    </tr>
    
    @foreach ($cotizaciones as $cotizacion)
    <tr>
    <td>{{ $cotizacion->id }}</td>
     <td>{{ $cotizacion->persona_id }}</td>
    <td>{{ $cotizacion->fecha_cotizacion }}</td>
    <td>@if ( $cotizacion->tipo_cotizacion ==1)CAPSULA @else SEMISOLIDO @endif</td>
    <td>{{ $cotizacion->valor }}</td>
    <td>{{ $cotizacion->estado }}</td>
    <td>
    
    <form action="{{ route('cotizacioncapsula.destroy',$cotizacion->id) }}" method="Post">
    
    <a class="btn btn-warning" href="{{ route('elegircotizacion',$cotizacion->id) }}">Cotizacion</a>
    <a class="btn btn-primary" href="{{ route('cotizacioncapsula.edit',$cotizacion->id) }}">Edit</a>
    @csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Delete</button>
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
