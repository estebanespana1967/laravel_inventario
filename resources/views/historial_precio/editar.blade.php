@extends('adminlte::page')

@section('title', 'HISTORIAL PRECIOS')

@section('content_header')
<h1>HISTORIAL PRECIOS</h1>
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
            <form action="{{ route('historial_precio.update', $historial_precio->id) }}" method="POST">
                @csrf
                @method('PUT')
                 <div class="form-group">
                  <label for="nombre">id</label>
                  <input type="text" class="form-control" id="id" name="id" placeholder="Ingresa el id" value="{{ $historial_precio->id }}" disabled >
                </div>
                <div class="form-group">
                  <label for="nombre">materia prima</label>
                  <input type="text" class="form-control" id="materia_prima" name="materia_prima" readonly value="{{ $historial_precio->materia_prima->nombre_mp }}"  >
                  <input type="hidden" class="form-control" id="id_materia_prima" name="id_materia_prima" readonly value="{{ $historial_precio->id_materia_prima }}"  >
                
                </div>
                <div class="form-group">
                  <label for="nombre">Precio compra</label>
                  <input type="text" class="form-control" id="precio_compra" name="precio_compra" readonly value="{{ $historial_precio->precio_compra }}" >
                </div>
                <div class="form-group">
                  <label for="nombre">Precio venta</label>
                  <input type="text" class="form-control" id="precio_venta" name="precio_venta" value="{{ $historial_precio->precio_venta }}" >
                </div>
                <div class="form-group">
                  <label for="nombre">Fecha precio</label>
                  <input type="text" class="form-control" id="fecha_precio" name="fecha_precio" readonly value="{{ $historial_precio->fecha_precio }}" >
                </div>
                
                <div class="form-group">
                  
                  <input type="hidden" class="form-control" id="id_detalle_entrada"  name="id_detalle_entrada" placeholder="Ingresa el cargo" value="{{ $historial_precio->id_detalle_entrada }}">
                </div>
                
                <button type="submit" class="btn btn-primary">Editar</button>
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