@extends('adminlte::page')

@section('title', 'EMPRESAS')

@section('content_header')
    <h1>EMPRESAS</h1>
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
<a class="btn btn-success" href="{{ route('empresas.create') }}"> Crear Empresa</a>
</div>
</div>
<div class="col-sm">
<form action="{{ route('empresas.index') }}" method="get">
<div class="input-group float-right">
<select class="form-control" name="termino_busqueda">
    <option value="1" selected>Nombre Empresa</option>
    <option value="2">Rut</option>
    </select>


<input type="search" name="nombre_empresa" id="nombre_empresa" class="form-control float-right" placeholder="Ingrese valor aqui" value="{{ $nombre_empresa }}"/>
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
<th>Tipo Empresa</th>
<th>Rut Empresa</th>
<th>dv Empresa</th>
<th>Nombre Empresa</th>
<th>Nombre Fantasia</th>
<th>Giro Comercial</th>
<th>Dirección Empresa</th>
<th>Comuna Empresa</th>
<th>Ciudad Empresa</th>
<th>Telefono Empresa</th>
<th width="280px">Acción</th></tr>
@foreach ($empresas as $empresa)
<tr>
<td>{{ $empresa->id }}</td>
<td>{{ $empresa->tipo_empresa }}</td>
<td>{{ $empresa->rut_empresa }}</td>
<td>{{ $empresa->dv_empresa }}</td>
<td>{{ $empresa->nombre_empresa }}</td>
<td>{{ $empresa->nombre_fantasia }}</td>
<td>{{ $empresa->giro_comercial }}</td>
<td>{{ $empresa->direccion_empresa }}</td>
<td>{{ $empresa->comuna_empresa }}</td>
<td>{{ $empresa->ciudad_empresa }}</td>
<td>{{ $empresa->telefono_empresa }}</td>
<td>
<form action="{{ route('empresas.destroy',$empresa->id) }}" method="Post" onsubmit="return confirm('¿Desea eliminar este registro?');">
<a class="btn btn-primary" href="{{ route('empresas.edit',$empresa->id) }}">Editar</a>
@csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>
</td>
</tr>
@endforeach
</table>
<div class="pagination justify-content-end">
{!! $empresas->links() !!}
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop