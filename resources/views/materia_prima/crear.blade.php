@extends('adminlte::page')

@section('title', 'Materia_prima')

@section('content_header')
    <h1>MATERIA_PRIMA</h1>
@stop

@section('content')
    <h1>materia_prima Nuevo</h1>
    
  </script>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ route('materia_prima.store') }}" method="POST">
                @csrf
                  <div class="form-group">
                  <label for="nombre">Nombre materia prima</label>
                  <input type="text" class="form-control" id="nombre_mp" name="nombre_mp" placeholder="Ingresa materia_prima" >
                </div>
                <div class="form-group">
                  <label for="nombre">Fecha vencto</label>
                  <input type="date" class="form-control" id="fecha_venci" name="fecha_venci" placeholder="Ingresa fecha venci" >
                </div>
                <div class="form-group">
                  <label for="nombre">Lote</label>
                  <input type="text" class="form-control" id="lote" name="lote" placeholder="Ingresa el lote">
                </div>
                <div class="form-group">
                  <label for="descripcion">Serie</label>
                  <input type="text" class="form-control" id="serie"  name="serie" placeholder="Ingresa serie">
                </div>
                <div class="form-group">
                  <label for="serial">Proveedor</label>
                  <input type="text" class="form-control" id="proveedor" name="proveedor" placeholder="Ingresa proveedor">
                </div>
                <div class="form-group">
                  <label for="serial">Costo por MG/ML</label>
                  <input type="text" class="form-control" id="costo" name="costo" placeholder="Ingresa costo">
                </div>
                <div class="form-group">
                  <label for="serial">Venta por MG/ML</label>
                  <input type="text" class="form-control" id="venta" name="venta" placeholder="Ingresa venta">
                </div>
                <div class="form-group">
                  <label for="serial">Stock</label>
                  <input type="text" class="form-control" id="stock" name="stock" placeholder="Ingresa stock">
                </div>
                <div class="form-group">
                <input type="radio" value="N" checked id="controlado" name="controlado">
                  <label for="controlado">No controlado</label>
                  <input type="radio" value="S" id="controlado" name="controlado">
                  <label for="controlado">Controlado</label>
    
                  
              </div>
                <button type="submit" class="btn btn-primary" >Crear</button>
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