@extends('adminlte::page')

@section('title', 'DETALLE DOCUMENTO ENTRADA')

@section('content_header')
    <h1>DETALLE DOCUMENTO </h1>
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
<div class="row">
<div class="col-10 border-right"><a class="btn btn-success" href="{{ route('entrada.detalle.create',$entrada->id) }}">Agregar Materia prima</a>
</div>
<div class="col-2">
</div>
</div>
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
<tr>
  <td>{{ $entrada->id }}</td>
@if ($entrada->tipo_documento==1)
<td>Factura</td>
@else 
<td>Guia Despacho</td>
@endif  
<td>{{ $entrada->numero_documento }}</td>

<td>{{ $entrada->empresa->nombre_empresa }}</td>

<td>{{ $entrada->fecha_emision }}</td>
<td>{{ $entrada->fecha_vencimiento }}</td>
<td>
</td>

</tr>
</table>



<table class="table table-bordered">
    <tr>
    <th>id</th>
    <th>Materia prima </th>
    <th>Cantidad mp</th>
    <th>Unidad medida</th>
    <th>Costo</th> 
    <th>Serie </th>
    <th>Lote </th>
    <th>Fecha vencimiento </th>
    <th>Subtotal </th>
    
    <th width="280px">Acción</th>
    </tr>
    <?php
    $resultado=0;
    ?>
      
     @foreach ($detalles_entrada as $detalle)
    
    <tr>
    <td>{{ $detalle->id }}</td>
    <td>{{ $detalle->materia_prima->nombre_mp }}</td>
    <td>{{ $detalle->cantidad_materia_prima }}</td>
    <td>{{ $detalle->unidad_medida}}</td>
    <td>{{ $detalle->costo}}</td> 
    <td>{{ $detalle->serie }}</td>
    <td>{{ $detalle->lote }}</td>
    <td>{{ $detalle->fecha_vencimiento}}</td>
    
    <?php
    $resultado= ($resultado+($detalle->cantidad_materia_prima*$detalle->costo));
    ?>
    <td>{{ number_format($detalle->cantidad_materia_prima*$detalle->costo, 2)}}</td>
    
    <td>
    <form action="{{ route('entrada.detalle.destroy',$detalle->id) }}" method="Post" onsubmit="return confirm('¿Desea eliminar este registro?');">
    
 <a class="btn btn-primary" href="{{ route('entrada.detalle.edit', $detalle->id) }}">Edit</a>

 @csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>

    </td>
    </tr>
    @endforeach
    
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <th>NETO</th>
    <td>{{ number_format($resultado, 2)}}</td>
    <td>
    </td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td><td></td>
    <td></td>
    <?php
    $iva= ($resultado)*0.19;
    $total=($resultado+$iva);
    ?>
    <th>IVA</th>
    <td>{{ number_format($iva, 2)}}</td>
    <td>
    </td>
    </tr>
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <th>TOTAL</th>
    
    <td>{{ number_format($total, 2)}}</td>
       
</td>
    <td>
    <div class="pull-right mb-2">
</div></td>
    </tr>
</table>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop