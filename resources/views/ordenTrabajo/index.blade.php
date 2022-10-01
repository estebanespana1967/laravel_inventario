@extends('adminlte::page')

@section('title', 'ORDEN DE TRABAJO')

@section('content_header')
    <h1>ORDEN DE TRABAJO</h1>
@stop

@section('content')
<div class="container mt-2">
<div class="row">
<div class="col-sm">
<form action="{{ route('orden_trabajo.index') }}" method="get">
<div class="input-group float-right">
<select class="form-control" name="termino_busqueda">
    <option value="1" selected>Nombre Paciente</option>
    <option value="2">Tipo Cotización</option>
    <option value="3">Estado</option>
    <option value="4">Fecha Recepción</option>
    
    
    </select>
<input type="search" name="nombre" id="nombre" class="form-control float-right" placeholder="Ingrese valor aqui" value="{{$nombre}}"/>
<button type="submit" class="btn btn-primary float-right">

<i class="fas fa-search"></i>
</button>
</div>
</form>
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
    <th>Paciente</th>
    <th>Fecha Recepción</th>
    <th>Tipo de cotización</th>
    <th>Valor</th>
    <th>Estado</th>
    <th width="280px">Acción</th>
    </tr>
    
    @foreach ($cotizaciones as $cotizacion)
    <tr>
    <td>{{ $cotizacion->id }}</td>
     <td>{{ $cotizacion->paciente->nombre_completo }}</td>
     <?php
     $newDate = date("d-m-Y", strtotime($cotizacion->fecha_cotizacion));
    ?>
    <td>{{ $newDate }}</td>
    <td>@if ( $cotizacion->tipo_cotizacion ==1)CAPSULA @else SEMISOLIDO @endif</td>
    <td>{{ $cotizacion->valor }}</td>
    <td>{{ $cotizacion->estado }}</td>
    <td>
    <form action="{{ route('orden_trabajo.updateEstado',$cotizacion->id)  }}" method="POST">
                    @csrf
   
                    @method('PUT')
                    <a class="btn btn-warning" href="{{ route('ver_index',$cotizacion->id) }}">Ver</a>
                    <a class="btn btn-primary" href="{{ route('ver_index_status',$cotizacion->id) }}">Ver Status</a>
                    @if ($cotizacion->estado == "TERMINADO")
                    
                    <a class="btn btn-success" href="{{ route('reportesMp.solicitarposicion',$cotizacion->id) }}">Imprimir</a>
                    @else
                <button type="submit" class="btn btn-danger">Terminado</button>
                    
                @endif 
         
                
 
                    
                    
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

@stop
