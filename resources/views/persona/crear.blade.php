@extends('adminlte::page')

@section('title', 'PACIENTE')

@section('content_header')
    <h1>CREAR PACIENTE</h1>
@stop

@section('content')
<div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ route('persona.store') }}" method="POST">
                @csrf
                  <div class="form-group">
                  <label for="nombre">Rut</label>
                  <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingresa el rut del persona" >
                </div>
                <div class="form-group">
                  <label for="nombre">dv</label>
                  <input type="text" class="form-control" id="dv" name="dv" placeholder="Ingresa el dv del persona" >
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre Completo</label>
                  <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" placeholder="Ingresa el nombre del persona">
                </div>
                <div class="form-group">
                  <label for="descripcion">Teléfono</label>
                  <input type="text" class="form-control" id="telefono"  name="telefono" placeholder="Ingresa el telefono">
                </div>
                <div class="form-group">
                  <label for="serial">Dirección</label>
                  <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresa la direccion">
                </div>
                <div class="form-group">
                  <label for="serial">Ciudad</label>
                  <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ingresa ciudad">
                </div>
                <div class="form-group">
                  <label for="serial">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Ingresa su email">
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