@extends('adminlte::page')

@section('title', 'STATUS MATERIA PRIMA')

@section('content_header')
    <h1>STATUS MATERIA PRIMA</h1>
@stop

@section('content')
<div class="container mt-2">
<div class="row">
<div class="col-sm">
<form action="{{ route('entrada.detalle.mp_status_index') }}" method="get">
<div class="input-group float-right">
<select class="form-control" name="termino_busqueda">
<option value="0">SELECCIONAR OPCION</option>
<option value="1">Nombre Materia Prima</option>
    <option value="2">Fecha Vencimiento(AAAA-MM-DD)</option>
    <option value="3">Status(SELLADO/EN USO/TERMINADO)</option>
    
    
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
    <th>Nombre Materia Prima</th>
    <th>Cantidad</th>
    <th>Unidad de medida</th>
    <th>Serie</th>
    <th>Lote</th>
    <th>Fecha Vencimiento</th>
    <th>status MP</th>
    <th>Stock MP </th>
    
    <th width="280px">Acción</th>
    </tr>
    
    @foreach ($mp_entradas as $mp_entrada)
    <tr>
    <td>{{ $mp_entrada->id }}</td>
    <td>{{ $mp_entrada->materia_prima->nombre_mp }}</td>
    <td>{{ $mp_entrada->cantidad_materia_prima }}</td>
    <td>{{ $mp_entrada->unidad_medida }}</td>
    <td>{{ $mp_entrada->serie }}</td>
    <td>{{ $mp_entrada->lote }}</td>
    <?php
     $newDate = date("d-m-Y", strtotime($mp_entrada->fecha_vencimiento));
    ?>
    <td>{{ $newDate }}</td>
    <td>{{ $mp_entrada->status_mp }}</td>
    <td>{{ $mp_entrada->stock_mp }}</td>
    
    <td>
    <form action="" method="POST">
                    @csrf
                    @method('PUT')
                    @if ($mp_entrada->status_mp == "SELLADO")
                    <a class="btn btn-success" href="{{ route('entrada.detalle.status_en_uso',$mp_entrada->id) }}">PONER EN USO</a>
                    @elseif ($mp_entrada->status_mp == "EN USO")
                <button type="submit" class="btn btn-primary">TERMINADO</button>
                @endif 
                </form>
    
    </td>
    </tr>
    @endforeach
</table>
<div class="pagination justify-content-end">
{!! $mp_entradas->links() !!}
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
