@extends('adminlte::page')

@section('title', 'PACIENTE')

@section('content_header')
<h1>EDITAR PACIENTE</h1>
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
            <form action="{{ route('paciente.update', $paciente->id) }}" method="POST">
                @csrf
                @method('PUT')
                 <div class="form-group">
                  <label for="nombre">id</label>
                  <input type="text" class="form-control" id="id" name="id" placeholder="Ingresa el id" value="{{ $paciente->id }}" disabled >
                </div>
                <div class="form-group">
                  <label for="nombre">Rut</label>
                  <input type="text" class="form-control" id="rut" name="rut" readonly value="{{ $paciente->rut }}"  >
                </div>
                <div class="form-group">
                  <label for="nombre">dv</label>
                  <input type="text" class="form-control" id="dv" name="dv" readonly value="{{ $paciente->dv }}" >
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre Completo</label>
                  <input type="text" class="form-control text-uppercase" id="nombre_completo" name="nombre_completo" placeholder="Ingresa el nombre del paciente" value="{{ $paciente->nombre_completo }}"  maxlength="28">
                </div>
                <div class="form-group">
                  <label for="descripcion">Teléfono</label>
                  <input type="text" class="form-control" id="telefono"  name="telefono" placeholder="Ingresa el telefono" value="{{ $paciente->telefono }}">
                </div>
                <div class="form-group">
                  <label for="serial">Dirección</label>
                  <input type="text" class="form-control text-uppercase" id="direccion" name="direccion" placeholder="Ingresa la direccion" value="{{ $paciente->direccion }}">
                </div>
                <div class="form-group">
                  <label for="serial">Ciudad</label>
                  <input type="text" class="form-control text-uppercase" id="ciudad" name=ciudad" placeholder="Ingresa la ciudad" value="{{ $paciente->ciudad }}">
                </div>
                <div class="form-group">
                  <label for="serial">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa su email" value="{{ $paciente->email }}">
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