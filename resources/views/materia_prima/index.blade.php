
@extends('adminlte::page')

@section('title', 'MATERIA_PRIMA')

@section('content_header')
    <h1>MATERIA_PRIMA</h1>
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
<div class="col-lg-12 margin-tb">
<div class="pull-left">

</div>
<div class="pull-right mb-2">
<a class="btn btn-success" href="{{ route('materia_prima.create') }}"> Crear materia prima</a>
</div>
</div>
<div class="col-sm">
<form action="{{ route('materia_prima.index') }}" method="get">
<div class="input-group float-right">
<select class="form-control" name="termino_busqueda">
    <option value="1" selected>Nombre Mat prima</option>
    <option value="2">Fecha vencim</option>
    </select>


<input type="search" name="nombre" id="nombre" class="form-control float-right" placeholder="Ingrese valor aqui" value="{{ $nombre }}"/>
<button type="submit" class="btn btn-primary float-right">
<i class="fas fa-search"></i>
</button>
</div>
</form>
</div>
</div>

<!-- @if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif -->
<table class="table table-bordered">
<tr>
<th>id</th>
<th>Nombre materia prima</th>
<th>Fecha vencto</th>
<th>Lote</th>
<th>Serie</th>
<th>Provee</th>
<th>Costo</th>
<th>Venta</th>
<th>Stock(MG/ML)</th>
<th>Cont</th>


<th width="280px">Acción</th>
</tr>
@foreach ($materia_primas as $materia_prima)
<tr>
<td>{{ $materia_prima->id }}</td>
<td>{{ $materia_prima->nombre_mp }}</td>
<?php
  $newDate= date("d-m-Y", strtotime($materia_prima->fecha_venci));
?>

<td>{{ $newDate }}</td>
<td>{{ $materia_prima->lote }}</td>
<td>{{ $materia_prima->serie }}</td>
<td>{{ $materia_prima->proveedor }}</td>
<td>{{ $materia_prima->costo }}</td>
<td>{{ $materia_prima->venta }}</td>

<TD>
{{ number_format($materia_prima->stock, 2)}}
</TD>
<td>{{ $materia_prima->controlado }}</td>

<td>
<form action="{{ route('materia_prima.destroy',$materia_prima->id) }}" method="Post" onsubmit="return confirm('¿Desea eliminar este registro?');">
<a class="btn btn-primary" href="{{ route('materia_prima.edit',$materia_prima->id) }}">Editar</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>
</td>
</tr>
@endforeach
</table>
<div class="pagination justify-content-end">
                                {!! $materia_primas->links() !!}
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop