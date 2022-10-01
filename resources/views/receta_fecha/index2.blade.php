@extends('adminlte::page')



@section('title', 'REPORTE RECETAS')

@section('content_header')
    <h1>REPORTE RECETA</h1>
@stop

@section('content')
<div class="container mt-2">
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif

<table class="table table-bordered">
    <tr>
    <th>Id</th>
    <th>Serie</th>
    <th>Rut Médico</th>
    <th>dv Médico</th>
    <th>Rut Paciente</th>
    <th>dv Paciente</th>
    <th>Dirección Paciente</th>
    <th>Ciudad</th>
    <th>Droga</th>
    <th>Cant Droga</th>
    <th>Unidad Medida</th>
    <th>FF</th>
    <th>Cantidad FF</th>
    <th>Fecha Receta</th>
    <th>Rut Adquirente</th>
    <th>dv Ad</th>
    <th>Fecha Recepción</th>
    <th>Rut QF</th>
    <th>Dv QF</th>
    <th>Nombre QF</th>
    <th>Cant FF</th>
    <th>FF</th>
    <th>No Local</th>
    </tr>
    
    @foreach ($recetas as $receta)
    <tr>
    <td>{{ $receta->id }}</td>
    <td>{{ $receta->serie }}{{ $receta->numero_controlado }}</td>
     <td>{{ $receta->medico->rut_medico }}</td>
    <td>{{ $receta->medico->dv_medico }}</td>
    <td>{{ $receta->paciente->rut }}</td>
    <td>{{ $receta->paciente->dv }}</td>
    <td>{{ $receta->paciente->direccion }}</td>
    <td>{{ $receta->paciente->ciudad }}</td>
    
    @foreach ($receta->cotizaciondetalle->materia_primas as $cotizacion)
    @if ($cotizacion->controlado=="S")
    <td>{{ $cotizacion->nombre_mp }}</td>
    <td>{{ $cotizacion->pivot->cantidad_materia_prima }}</td>
    @endif
    @endforeach
    <td>GRS</td>
    <td>@if ($receta->cotizaciondetalle->tipo_cotizacion==1)
    CAPSULA   @else CREMA @endif
    </td>
    <td>{{ $receta->cotizaciondetalle->cantidad_capsulas }}</td>
    <?php    
    $newDate1= date("d-m-Y", strtotime($receta->fecha_receta));
    $newDate2= date("d-m-Y", strtotime($receta->fecha_recepcion));
    
    ?>
    <td>{{ $newDate1 }}</td>
    <td>{{ $receta->rut_adquirente }}</td>
    <td>{{ $receta->dv_adquirente }}</td>
    <td>{{ $newDate2 }}</td>
    <td>{{ $receta->rut_dt }}</td>
    <td>{{ $receta->dv_dt }}</td>
    <td>{{ $receta->director_tecnico }}</td>
    <td>{{ $receta->cotizaciondetalle->cantidad_capsulas }}</td>
    <td>@if ($receta->cotizaciondetalle->tipo_cotizacion==1)  CAPSULA   @else CREMA @endif</td>
    
    <td>
    <a class="btn btn-success" href="{{ route('ver_index',$receta->numero_interno) }}">ver Cotizacion</a>
       
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
