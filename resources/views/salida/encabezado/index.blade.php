@extends('adminlte::page')

@section('title', 'SALIDA')

@section('content_header')
    <h1>ENCABEZADO SALIDA</h1>
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
<a class="btn btn-success" href="{{ route('salida.encabezado.create') }}"> Crear Salida</a>
</div>
</div>
<div class="col-sm">
<form action="{{ route('salida.encabezado.index') }}" method="get">
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
@foreach ($salidas as $salida)
<tr>
  <td>{{ $salida->id }}</td>
@if ($salida->tipo_documento==1)
<td>Factura</td>
@else 
<td>Guia Despacho</td>
@endif  
<td>{{ $salida->numero_documento }}</td>
<td>{{ $salida->empresa->nombre_empresa }}</td>
<td>{{ $salida->fecha_emision }}</td>
<td>{{ $salida->fecha_vencimiento }}</td>
<td>

<form action="{{ route('salida.encabezado.destroy',$salida->id) }}" method="Post" onsubmit="return confirm('¿Desea eliminar este registro?');">
<a class="btn btn-warning" href="{{ route('salida.detalle.index',$salida->id) }}">Detalle</a>

<a class="btn btn-primary" href="{{ route('salida.encabezado.edit',$salida->id) }}">Editar</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>
</td>
</tr>
@endforeach
</table>
<div class="pagination justify-content-end">
{!! $salidas->links() !!}
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop