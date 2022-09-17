@extends('adminlte::page')

@section('title', 'PACIENTE')

@section('content_header')
    <h1>LISTADO DE PACIENTES</h1>
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
<a class="btn btn-success" href="{{ route('paciente.create') }}"> Crear paciente</a>
</div>
</div>

<div class="col-sm">
<form action="{{ route('paciente.index') }}" method="get">
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
<th>Rut</th>
<th>dv</th>
<th>Nombre completo</th>
<th>Teléfono</th>
<th>Dirección</th>
<th>Ciudad</th>

<th>Email</th>
<th width="280px">Acción</th>
</tr>
@foreach ($pacientes as $paciente)
<tr>
<td>{{ $paciente->id }}</td>
<td>{{ $paciente->rut }}</td>
<td>{{ $paciente->dv }}</td>
<td>{{ $paciente->nombre_completo }}</td>
<td>{{ $paciente->telefono }}</td>
<td>{{ $paciente->direccion }}</td>
<td>{{ $paciente->ciudad }}</td>

<td>{{ $paciente->email }}</td>
<td>
<form action="{{ route('paciente.destroy',$paciente->id) }}" method="Post" onsubmit="return confirm('¿Desea eliminar este registro?');">
<a class="btn btn-primary" href="{{ route('paciente.edit',$paciente->id) }}">Editar</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>
</td>
</tr>
@endforeach
</table>
<div class="pagination justify-content-end">
 {!! $pacientes->links() !!}
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop