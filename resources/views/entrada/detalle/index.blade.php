@extends('adminlte::page')

@section('title', 'DETALLE ENTRADA')

@section('content_header')
    <h1>DETALLE ENTRADAS</h1>
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
</div>
    <table class="table table-bordered">
<tr>
<th>S.No</th>
<th>Rut Empresa</th>
<th>dv Empresa</th>
<th>Nombre Empresa</th>
<th>Giro Comercial</th>
<th>Dirección Empresa</th>
<th>Comuna Empresa</th>
<th>Ciudad Empresa</th>
<th>Numero Documento</th>
<th>Fecha Emision</th>
<th>Fecha Vencimiento</th>

<tr>
<td>{{ $encabezado_entrada->id }}</td>
<td>{{ $encabezado_entrada->empresa->rut_empresa }}</td>
<td>{{ $encabezado_entrada->empresa->dv_empresa }}</td>
<td>{{ $encabezado_entrada->empresa->nombre_empresa }}</td>
<td>{{ $encabezado_entrada->empresa->giro_comercial }}</td>
<td>{{ $encabezado_entrada->empresa->direccion_empresa }}</td>
<td>{{ $encabezado_entrada->empresa->comuna_empresa }}</td>
<td>{{ $encabezado_entrada->empresa->ciudad_empresa }}</td>
<td>{{ $encabezado_entrada->numero_documento }}</td>
<td>{{ $encabezado_entrada->fecha_emision }}</td>
<td>{{ $encabezado_entrada->fecha_vencimiento }}</td>
</tr>
</table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop