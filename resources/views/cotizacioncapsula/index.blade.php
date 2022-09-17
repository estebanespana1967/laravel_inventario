@extends('adminlte::page')

@section('title', 'HISTORIAL DE COTIZACIONES')

@section('content_header')
    <h1>HISTORIAL DE COTIZACIONES</h1>
@stop

@section('content')
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-right mb-2">
<a class="btn btn-success" href="{{ route('cotizacioncapsula.create',$paciente->id) }}"> Crear cotización</a>
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
<th>S.No pagina</th>
<th>Rut</th>
<th>dv</th>
<th>Nombre completo</th>
<th>Teléfono</th>
<th>Dirección</th>
<th>Email</th>
</tr>
<tr>
<td>{{ $paciente->id }}</td>
<td>{{ $paciente->rut }}</td>
<td>{{ $paciente->dv }}</td>
<td>{{ $paciente->nombre_completo }}</td>
<td>{{ $paciente->telefono }}</td>
<td>{{ $paciente->direccion}}</td>
<td>{{ $paciente->email }}</td>

</tr>
</table>

<table class="table table-bordered">
    <tr>
    <th>Id</th>
    <th>Cantidad Cápsulas/Semisolido</th>
    <th>Tipo de cotización</th>
    <th>Fecha de cotización</th>
    <th width="280px">Acción</th>
    </tr>
    
    @foreach ($cotizaciones as $cotizacion)
    <tr>
    <td>{{ $cotizacion->id }}</td>
    <td>{{ $cotizacion->cantidad_capsulas }}</td>
    <td>@if ( $cotizacion->tipo_cotizacion ==1)CAPSULA @else SEMISOLIDO @endif</td>
    
    <?php
  
    $newDate = date("d-m-Y", strtotime($cotizacion->fecha_cotizacion));
    ?>
    <td>{{ $newDate }}</td>
    <td>
    
    <form action="{{ route('cotizacioncapsula.destroy',$cotizacion->id) }}" method="Post">
    
    <a class="btn btn-warning" href="{{ route('elegircotizacion',$cotizacion->id) }}">Cotización</a>
    <a class="btn btn-primary" href="{{ route('cotizacioncapsula.edit',$cotizacion->id) }}">Edit</a>
    @csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>    
       
    </td>
    </tr>
    @endforeach
</table>
<div class="pagination justify-content-end">
{!! $cotizaciones->links() !!}
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
