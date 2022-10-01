@extends('adminlte::page')

@section('title', 'RESPONSABLES')

@section('content_header')
    <h1>LISTADO DE RESPONSABLES</h1>
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
<a class="btn btn-success" href="{{ route('responsable.create') }}"> Crear Responsable</a>
</div>
</div>
<div class="col-sm">
<form action="{{ route('responsable.index') }}" method="get">
<div class="input-group float-right">
<select class="form-control" name="termino_busqueda">
    <option value="1" selected>Nombre</option>
    <option value="2">Rut</option>
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
<th>Rut Responsable</th>
<th>dv Responsable</th>
<th>Nombre Responsable</th>
<th>Cargo</th>


<th width="280px">Acción</th></tr>
@foreach ($responsables as $responsable)
<tr>
<td>{{ $responsable->id }}</td>
<td>{{ $responsable->rut_responsable }}</td>
<td>{{ $responsable->dv_responsable }}</td>
<td>{{ $responsable->nombre_apellido }}</td>
<td>{{ $responsable->cargo }}</td>


<td>
<form action="{{ route('responsable.destroy',$responsable->id) }}" method="Post" onsubmit="return confirm('¿Desea eliminar este registro?');">
<a class="btn btn-primary" href="{{ route('responsable.edit',$responsable->id) }}">Editar</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>
</td>
</tr>
@endforeach
</table>
<div class="pagination justify-content-end">
{!! $responsables->links() !!}
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop