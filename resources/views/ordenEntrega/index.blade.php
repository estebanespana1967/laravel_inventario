@extends('adminlte::page')

@section('title', 'ORDEN DE ENTREGA')

@section('content_header')
    <h1>ORDEN DE ENTREGA</h1>
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
    <th>Fecha Recepción</th>
    <th>Tipo de cotización</th>
    <th>Valor</th>
    <th>Estado</th>
    <th>Responsable</th>
    
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
    @if ($cotizacion->responsable_entrega =='')
    <td>SIN CONVENIO</td>
    @else  
    <td>{{ $cotizacion->responsable_entrega }}</td>
    @endif
    
    <td>
    <form action="{{ route('orden_entrega.updateEstado',$cotizacion->id)  }}" method="POST">
                    @csrf
   
                    @method('PUT')
                <a class="btn btn-warning" href="{{ route('ver_index',$cotizacion->id) }}">Ver</a>
                @if ($cotizacion->estado=="ENTREGADO")
                <button type="submit" class="btn btn-primary d-none" >Entregado</button>
                @else
                <button type="submit" class="btn btn-primary">Entregado</button>
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
    <script> console.log('Hi!'); </script>
@stop
