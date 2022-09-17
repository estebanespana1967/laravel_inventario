@extends('adminlte::page')

@section('title', 'MEDICO')

@section('content_header')
    <h1>MÉDICOS</h1>
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
<a class="btn btn-success" href="{{ route('medico.create') }}"> Crear Médico</a>
</div>
</div>
<div class="col-sm">
<form action="{{ route('medico.index') }}" method="get">
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
<th>Rut Médico</th>
<th>dv Médico</th>
<th>Nombre Médico</th>
<th>Telefono Médico</th>
<th>Dirección Médico</th>
<th>Email Médico</th>
<th>Especialidad</th>

<th width="280px">Acción</th></tr>
@foreach ($medicos as $medico)
<tr>
<td>{{ $medico->id }}</td>
<td>{{ $medico->rut_medico }}</td>
<td>{{ $medico->dv_medico }}</td>
<td>{{ $medico->nombre_medico }}</td>
<td>{{ $medico->telefono_medico }}</td>
<td>{{ $medico->direccion_medico }}</td>
<td>{{ $medico->email_medico }}</td>
<td>{{ $medico->especialidad }}</td>

<td>
<form action="{{ route('medico.destroy',$medico->id) }}" method="Post" onsubmit="return confirm('¿Desea eliminar este registro?');">
<a class="btn btn-primary" href="{{ route('medico.edit',$medico->id) }}">Editar</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>
</td>
</tr>
@endforeach
</table>
<div class="pagination justify-content-end">
{!! $medicos->links() !!}
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop