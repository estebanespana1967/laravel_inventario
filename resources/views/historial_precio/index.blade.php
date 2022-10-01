@extends('adminlte::page')

@section('title', 'HISTORIAL PRECIOS')

@section('content_header')
    <h1>HISTORIAL PRECIOS</h1>
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

</div>
<div class="col-sm">
<form action="{{ route('historial_precio.index') }}" method="get">
<div class="input-group float-right">
<select class="form-control" name="termino_busqueda">
    <option value="1" selected>Nombre</option>
    <option value="2">FEcha</option>
    </select>


<input type="search" name="nombre" id="nombre" class="form-control float-right" placeholder="Ingrese valor aqui" value="{{ $nombre }}"/>
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
<th>id_materia_prima</th>
<th>precio_compra</th>
<th>precio_venta</th>
<th>id_detalle_entrada</th>
<th>fecha_precio</th>

<th width="280px">Acción</th></tr>
@foreach ($historiales as $historial_precio)
<tr>
<td>{{ $historial_precio->id }}</td>
<td>{{ $historial_precio->materia_prima->nombre_mp }}</td>
<td>{{ $historial_precio->precio_compra }}</td>
<td>{{ $historial_precio->precio_venta }}</td>
<td>{{ $historial_precio->id_detalle_entrada }}</td>
<td>{{ $historial_precio->fecha_precio }}</td>



<td>

<a class="btn btn-primary" href="{{ route('historial_precio.edit',$historial_precio->id) }}">Editar</a>
</td>
</tr>
@endforeach
</table>
<div class="pagination justify-content-end">
{!! $historiales->links() !!}
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop