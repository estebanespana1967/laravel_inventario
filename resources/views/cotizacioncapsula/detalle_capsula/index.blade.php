@extends('adminlte::page')

@section('title', 'COTIZACION')

@section('content_header')
    <h1>PREPARADO COTIZACION CAPSULA</h1>
@stop

@section('content')
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">

<div class="row">
<div class="col-10 border-right"><a class="btn btn-success" href="{{ route('cotizacioncapsula.crearMateriaPrima',$cotizacion_detalle->id) }}">Agregar Materia prima</a>
</div>
<div class="col-2">
<form action="{{ route('cotizacioncapsula.updateEstadoCapsula',$cotizacion_detalle->id)  }}" method="POST">
                @csrf
                @method('PUT') 
                @if ( $cotizaciones->isNotEmpty())         
                @if ($cotizacion_existe->isEmpty())         
                <p>Elige tipo de receta</p>
        <label>
            <input type="radio" name="tipo_receta" value="cheque" checked> Cheque
        </label>
        <label>
            <input type="radio" name="tipo_receta" value="blanca"> Blanca
        </label>

         <button type="submit" class="btn btn-primary">Pagado</button> 
    @else
    <a class="btn btn-warning" href="{{ route('receta.edit',$cotizacion_detalle->receta->id) }}">Ver Receta</a>
    @endif
    @endif
    

</form>
</div>
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
<th>id_paciente</th>
<th>Nombre apellido</th>
<th>Cantidad capsulas</th>
<th>Fecha cotización</th>
<th>Estado</th>

</tr>
<tr>
<td>{{ $paciente->id}}</td>
<td>{{ $paciente->nombre_completo }}</td>
<td>{{ $cotizacion_detalle->cantidad_capsulas }}</td>
    <?php
$newDate = date("d-m-Y", strtotime($cotizacion_detalle->fecha_cotizacion));
    
    ?>
<td>{{ $newDate }}</td>
<td>{{ $cotizacion_detalle->estado }}</td>
</tr>
</table>

<table class="table table-bordered">
    <tr>
    <th>Id</th>
    <th>Materia_id</th>
    <th>Cantidad</th>
    <th>Costo</th>
    <th>subtotal</th>
    
    <th width="280px">Acción</th>
    </tr>
    <?php
    $resultado=0;
?>
      
     @foreach ($cotizacion_detalle->materia_primas as $cotizacion)
    
    <tr>
    <td>{{ $cotizacion->pivot->id }}</td>
    <td>{{ $cotizacion->nombre_mp }}</td>
    <td>{{ $cotizacion->pivot->cantidad_materia_prima }}</td>
    <td>{{ $cotizacion->pivot->costo_materia_prima }}</td>
    <td>{{$cotizacion->pivot->cantidad_materia_prima*$cotizacion->pivot->costo_materia_prima}}</td>
    <?php
    $resultado= ($resultado+($cotizacion->pivot->cantidad_materia_prima*$cotizacion->pivot->costo_materia_prima));
    ?>
    <td>
    <form action="{{ route('cotizacioncapsula.detalle_capsula.eliminarMateriaPrima',$cotizacion->pivot->id) }}" method="Post">
    
 <a class="btn btn-primary" href="{{ route('cotizacioncapsula.editarMateriaPrima', $cotizacion->pivot->id) }}">Edit</a>

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
    <td>{{ $cotizacion_detalle->cantidad_capsulas }}</td>
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
    <td>total</td>
    <?php
    $parcial= ($resultado+50)*($cotizacion_detalle->cantidad_capsulas);
    $parcial=round($parcial*0.01)*100;
    $valor=$parcial;
    ?>
    <td>{{ number_format($parcial, 2)}}</td>
       
</td>
    <td>
    <div class="pull-right mb-2">
</div></td>
    </tr>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop