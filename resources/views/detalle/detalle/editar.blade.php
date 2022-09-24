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
            <form action="{{ route('entrada.detalle.update',$detalle_entrada->id) }}" method="POST">
                @csrf
                @method('PUT')
                  <div class="form-group">
                  <input type="hidden" class="form-control" id="id_encabezado_entrada" name="id_encabezado_entrada" value="{{ $detalle_entrada->id_encabezado_entrada }}" >
                  </div>
                  
                
                <div class="form-group">
                  <label for="id_materia_prima">Materia prima</label>
                  <select class="form-control" name="id_materia_prima">
                  <option selected disabled>Seleccionar</option>
                  @foreach ($materia_primas as $materia_prima)
                  @if ($materia_prima->id == $detalle_entrada->id_materia_prima )
                  
                  <option value="{{ $materia_prima->id}}" selected>{{ $materia_prima->nombre_mp }}</option>
                  @else
                  <option value="{{ $materia_prima->id}}">{{ $materia_prima->nombre_mp }}</option>
                  
                  @endif
                  @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="cantidad_materia_prima">Cantidad materia prima</label>
                  <input type="text" class="form-control" id="cantidad_materia_prima" name="cantidad_materia_prima" value="{{ $detalle_entrada->cantidad_materia_prima}}">
                </div>
                <div class="form-group">
                  <label for="unidad_medida">Unidad de medida</label>
                  <input type="text" class="form-control" id="unidad_medida" name="unidad_medida"  value="{{ $detalle_entrada->unidad_medida }}">
                </div>
                <div class="form-group">
                  <label for="costo">Costo</label>
                  <input type="text" class="form-control" id="costo" name="costo"  value="{{ $detalle_entrada->costo }}">
                </div>
                <div class="form-group">
                  <label for="serie">Serie</label>
                  <input type="text" class="form-control" id="serie" name="serie"  value="{{ $detalle_entrada->serie }}">
                </div>
                <div class="form-group">
                  <label for="lote">Lote</label>
                  <input type="text" class="form-control" id="lote" name="lote"  value="{{ $detalle_entrada->lote }}">
                </div>
                <div class="form-group">
                  <label for="fecha_vencimiento">Fecha Vencimiento</label>
                  <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento"  value="{{ $detalle_entrada->fecha_vencimiento }}">
                </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
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