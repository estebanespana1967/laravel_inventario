@extends('adminlte::page')

@section('title', 'MEDICO')

@section('content_header')
    <h1>EDITAR MEDICO</h1>
@stop

@section('content')
    <h1>medico Editar</h1>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ route('medico.update', $medico->id) }}" method="POST">
                @csrf
                @method('PUT')
                 <div class="form-group">
                  <label for="nombre">id</label>
                  <input type="text" class="form-control" id="id" name="id" placeholder="Ingresa el id" value="{{ $medico->id }}" disabled >
                </div>
                <div class="form-group">
                  <label for="nombre">Rut</label>
                  <input type="text" class="form-control" id="rut_medico" name="rut_medico" placeholder="Ingresa el rut del medico" value="{{ $medico->rut_medico }}"  >
                </div>
                <div class="form-group">
                  <label for="nombre">dv</label>
                  <input type="text" class="form-control" id="dv_medico" name="dv_medico" placeholder="Ingresa el dv del medico" value="{{ $medico->dv_medico }}" >
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre Médico</label>
                  <input type="text" class="form-control text-uppercase" id="nombre_medico" name="nombre_medico" placeholder="Ingresa el nombre del medico" value="{{ $medico->nombre_medico }}"  maxlength="28">
                </div>
                <div class="form-group">
                  <label for="descripcion">Telefono médico</label>
                  <input type="text" class="form-control" id="telefono_medico"  name="telefono_medico" placeholder="Ingresa el telefono" value="{{ $medico->telefono_medico }}">
                </div>
                <div class="form-group">
                  <label for="serial">Direccion médico</label>
                  <input type="text" class="form-control text-uppercase" id="direccion_medico" name="direccion_medico" placeholder="Ingresa la direccion medico" value="{{ $medico->direccion_medico }}">
                </div>
                <div class="form-group">
                  <label for="serial">Email</label>
                  <input type="text" class="form-control" id="email_medico" name="email_medico" placeholder="Ingresa su email" value="{{ $medico->email_medico }}">
                </div>
		<div class="form-group">
                  <label for="serial">Especialidad</label>
                  <input type="text" class="form-control text-uppercase" id="especialidad" name="especialiad" placeholder="Ingresa su especialiad" value="{{ $medico->especialidad }}">
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