@extends('adminlte::page')

@section('title', 'AGREGAR MATERIA PRIMA')

@section('content_header')
    <h1>AGREGAR MATERIA PRIMA</h1>
@stop

@section('content')
<div class="row">
        <div class="col-1"></div>
        <div class="col-10">
        @if ($errors->any())
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Chequee la siguiente información!</strong>
                            @foreach ($errors->all() as $error)
                            <br>
                                <span class="badge badge-danger">{{ $error }}</span>
                            @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif    
                    </div>
                    </div>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ route('entrada.detalle.store') }}" method="POST">
                @csrf
                  <div class="form-group">
                  <input type="hidden" class="form-control" id="id_encabezado_entrada" name="id_encabezado_entrada" value="{{ $encabezado_entrada->id }}" >
                  </div>
                  
                
                <div class="form-group">
                  <label for="id_materia_prima">Materia prima</label>
                  <select class="form-control" name="id_materia_prima">
                  <option selected disabled>Seleccionar</option>
                  @foreach ($materia_primas as $materia_prima)
                  <option value="{{ $materia_prima->id}}">{{ $materia_prima->nombre_mp }}</option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="cantidad_materia_prima">Cantidad materia prima</label>
                  <input type="text" class="form-control" id="cantidad_materia_prima" name="cantidad_materia_prima" placeholder="cantidad materia prima">
                </div>
                <div class="form-group">
                  <label for="unidad_medida">Unidad de medida</label>
                  <input type="text" class="form-control" id="unidad_medida" name="unidad_medida" placeholder="unidad_medida">
                </div>
                <div class="form-group">
                <div class="row">
                  <div class="col-sm">
                    <label for="costo">Costo</label>
                  <input type="text" class="form-control" id="costo" name="costo" placeholder="costo">
                </div>
                  <div class="col-sm"><label for="venta">Venta</label>
                  <input type="text" class="form-control" id="venta" name="venta" placeholder="venta">
                </div>
                  <div class="col-sm"><label for="ultimo_precio">Ultimo precio</label>
                  <input type="text" class="form-control" id="ultimo_precio" name="ultimo_precio" placeholder="costo">
                </div>
                  
                  </div>  
                  </div>
                <div class="form-group">
                  <label for="serie">Serie</label>
                  <input type="text" class="form-control" id="serie" name="serie" placeholder="serie">
                </div>
                <div class="form-group">
                  <label for="lote">Lote</label>
                  <input type="text" class="form-control" id="lote" name="lote" placeholder="lote">
                </div>
                <div class="form-group">
                  <label for="fecha_vencimiento">Fecha Vencimiento</label>
                  <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="fecha_vencimiento">
                </div>
                        <button type="submit" class="btn btn-primary">Crear</button>
              </form>
        </div>
        <div class="col-1"></div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop