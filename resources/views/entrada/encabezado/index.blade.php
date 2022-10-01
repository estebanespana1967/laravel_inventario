@extends('adminlte::page')

@section('title', 'ENTRADA')

@section('content_header')
    <h1>ENCABEZADO ENTRADA</h1>
@stop

@section('content')
    <div class="container mt-2">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        @if (session('destroy'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('destroy') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

    <div class="row">
<div class="col-sm">
<div class="pull-right mb-2">
<a class="btn btn-success" href="{{ route('entrada.encabezado.create') }}"> Crear Entrada</a>
</div>
</div>
<div class="col-sm">
<form action="{{ route('entrada.encabezado.index') }}" method="get">
<div class="input-group float-right">
<select class="form-control" name="termino_busqueda">
    <option value="1" selected>Nombre Empresa</option>
    <option value="2">Rut</option>
    </select>


<input type="search" name="nombre_empresa" id="nombre_empresa" class="form-control float-right" placeholder="Ingrese valor aqui" value=""/>
<button type="submit" class="btn btn-primary float-right">
<i class="fas fa-search"></i>
</button>
</div>
</form>
</div>
</div>
<table class="table table-bordered">
<tr>
<th>S.No</th>
<th>Tipo documento</th>
<th>Numero documento</th>
<th>Empresa</th>
<th>Fecha Emision</th>
<th>Fecha Vencimiento</th>
<th width="280px">Acción</th></tr>
@foreach ($entradas as $entrada)
<tr>
  <td>{{ $entrada->id }}</td>
@if ($entrada->tipo_documento==1)
<td>Factura</td>
@else 
<td>Guia Despacho</td>
@endif  
<td>{{ $entrada->numero_documento }}</td>

<td>{{ $entrada->empresa->nombre_empresa }}</td>
<?php
     $fecha_emi = date("d-m-Y", strtotime($entrada->fecha_emision));
     $fecha_venci = date("d-m-Y", strtotime($entrada->fecha_vencimiento));

?>
    <td>{{ $fecha_emi }}</td>
    <td>{{ $fecha_venci }}</td>
<td>

<form action="{{ route('entrada.encabezado.destroy',$entrada->id) }}" method="Post" onsubmit="return confirm('¿Desea eliminar este registro?');">
<a class="btn btn-warning" href="{{ route('entrada.detalle.index',$entrada->id) }}">Detalle</a>

<a class="btn btn-primary" href="{{ route('entrada.encabezado.edit',$entrada->id) }}">Editar</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>
</td>
</tr>
@endforeach
</table>
<div class="pagination justify-content-end">
{!! $entradas->links() !!}
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop