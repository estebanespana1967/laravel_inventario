@extends('adminlte::page')

@section('title', 'MATERIA_PRIMA')

@section('content_header')
    <h1>MATERIA MATERIA_PRIMA</h1>
@stop

@section('content')
    <h1>materia_prima Editar</h1>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ route('materia_prima.update', $materia_prima->id) }}" method="POST">
                @csrf
                @method('PUT')
                 <div class="form-group">
                  <label for="nombre">id</label>
                  <input type="text" class="form-control" id="id" name="id" placeholder="Ingresa el id" value="{{ $materia_prima->id }}" disabled >
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre Materia Prima</label>
                  <input type="text" class="form-control" id="nombre_mp" name="nombre_mp" placeholder="Ingresa el nombre mp" value="{{ $materia_prima->nombre_mp }}"  >
                </div>
                <div class="form-group">
                  <label for="nombre">Fecha vencto</label>
                  <input type="date" class="form-control" id="fecha_venci" name="fecha_venci" placeholder="Ingresa fecha vencim" value="{{ $materia_prima->fecha_venci }}" >
                </div>
                <div class="form-group">
                  <label for="nombre">Lote</label>
                  <input type="text" class="form-control" id="lote" name="lote" placeholder="Ingresa el lote" value="{{ $materia_prima->lote }}">
                </div>
                <div class="form-group">
                  <label for="nombre">Serie</label>
                  <input type="text" class="form-control" id="serie"  name="serie" placeholder="Ingresa la serie" value="{{ $materia_prima->serie }}">
                </div>
                <div class="form-group">
                  <label for="nombre">Proveedor</label>
                  <input type="text" class="form-control" id="proveedor" name="proveedor" placeholder="Ingresa proveedor" value="{{ $materia_prima->proveedor }}">
                </div>
                <div class="form-group">
                  <label for="nombre">Costo</label>
                  <input type="text" class="form-control" id="costo" name="costo" placeholder="Ingresa costo" value="{{ $materia_prima->costo }}">
                </div>
                <div class="form-group">
                  <label for="nombre">Venta</label>
                  <input type="text" class="form-control" id="venta" name="venta" placeholder="Ingresa valor venta" value="{{ $materia_prima->venta }}">
                </div><div class="form-group">
                  <label for="nombre">Stock</label>
                  <input type="text" class="form-control" id="stock" name="stock" placeholder="Ingresa stock" value="{{ $materia_prima->stock }}">
                </div>
                  <div class="form-group">
                    @if ($materia_prima->controlado == "S")
                    <input type="radio" value="N" id="controlado" name="controlado">
                  <label for="controlado">No controlado</label>
  
                  <input type="radio" value="S" checked id="controlado" name="controlado">
                  <label for="controlado">Controlado</label>
                  @else  
                  <input type="radio" value="N" checked id="controlado" name="controlado">
                  <label for="controlado">No controlado</label>
                  <input type="radio" value="S" id="controlado" name="controlado">
                  <label for="controlado">Controlado</label>
                  @endif
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