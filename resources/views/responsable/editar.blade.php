@extends('adminlte::page')

@section('title', 'RESPONSABLE')

@section('content_header')
<h1>EDITAR RESPONSABLE</h1>
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
            <form action="{{ route('responsable.update', $responsable->id) }}" method="POST">
                @csrf
                @method('PUT')
                 <div class="form-group">
                  <label for="nombre">id</label>
                  <input type="text" class="form-control" id="id" name="id" placeholder="Ingresa el id" value="{{ $responsable->id }}" disabled >
                </div>
                <div class="form-group">
                  <label for="nombre">Rut Responsable</label>
                  <input type="text" class="form-control" id="rut" name="rut_responsable" readonly value="{{ $responsable->rut_responsable }}"  >
                </div>
                <div class="form-group">
                  <label for="nombre">dv Responsable</label>
                  <input type="text" class="form-control" id="dv_responsable" name="dv_responsable" readonly value="{{ $responsable->dv_responsable }}" >
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre y Apellido</label>
                  <input type="text" class="form-control text-uppercase" id="nombre_apellido" name="nombre_apellido" placeholder="Ingresa el nombre y apellido del responsable" value="{{ $responsable->nombre_apellido }}"  maxlength="28">
                </div>
                <div class="form-group">
                  <label for="descripcion">cargo</label>
                  <input type="text" class="form-control" id="cargo"  name="cargo" placeholder="Ingresa el cargo" value="{{ $responsable->cargo }}">
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