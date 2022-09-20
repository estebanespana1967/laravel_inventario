@extends('adminlte::page')

@section('title', 'EMPRESA')

@section('content_header')

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
    
    <h1> Empresa Editar</h1>
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ route('empresas.update', $empresa->id) }}" method="POST">
                @csrf
                @method('PUT')
                 <div class="form-group">
                  <label for="nombre">id</label>
                  <input type="text" class="form-control" id="id" name="id" placeholder="Ingresa el id" value="{{ $empresa->id }}" disabled >
                  </div>
                <div class="form-group">
                  <label for="nombre">Rut</label>
                  <input type="text"  readonly  class="form-control" id="rut_empresa" name="rut_empresa" placeholder="Ingresa el rut de la empresa" value="{{ $empresa->rut_empresa }}"  >
                </div>
                <div class="form-group">
                  <label for="nombre">Dv Empresa</label>
                  <input type="text" readonly class="form-control" id="dv_empresa" name="dv_empresa" placeholder="Ingresa el dv de la empresa" value="{{ $empresa->dv_empresa }}"  >
                </div>
               
                <div class="form-group">
                  <label for="nombre">Nombre Empresa</label>
                  <input type="text" class="form-control text-uppercase" id="nombre_empresa" name="nombre_empresa" placeholder="Ingresa el nombre de la empresa"  maxlength="28" value="{{ $empresa->nombre_empresa }}"  >
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre Fantasia</label>
                  <input type="text" class="form-control text-uppercase" id="nombre_fantasia" name="nombre_fantasia" placeholder="Ingresa el nombre de la empresa"  maxlength="28" value="{{ $empresa->nombre_fantasia }}"  >
                </div>
                <div class="form-group">
                  <label for="nombre">Giro Comercial</label>
                  <input type="text" class="form-control text-uppercase" id="giro_comercial" name="giro_comercial" placeholder="Ingresa el nombre de la empresa"  maxlength="28" value="{{ $empresa->giro_comercial }}"  >
                </div>
                <div class="form-group">
                  <label for="serial">Dirección Empresa</label>
                  <input type="text" class="form-control text-uppercase" id="direccion_empresa" name="direccion_empresa" placeholder="Ingresa la direccion de la empresa" value="{{ $empresa->direccion_empresa }}"  >
                </div>
                <div class="form-group">
                  <label for="serial">Comuna Empresa</label>
                  <input type="text" class="form-control text-uppercase" id="comuna_empresa" name="comuna_empresa" placeholder="Ingresa la comuna de la empresa" value="{{ $empresa->comuna_empresa }}"  >
                </div>
                <div class="form-group">
                  <label for="serial">Ciudad Empresa</label>
                  <input type="text" class="form-control text-uppercase" id="ciudad_empresa" name="ciudad_empresa" placeholder="Ingresa la ciudad de la empresa" value="{{ $empresa->ciudad_empresa }}"  >
                </div>
                <div class="form-group">
                  <label for="serial">Teléfono Empresa</label>
                  <input type="text" class="form-control text-uppercase" id="telefono_empresa" name="telefono_empresa" placeholder="Ingresa el telefono de la empresa" value="{{ $empresa->telefono_empresa }}"  >
                </div>
                <div class="form-group">
                  <label for="serial">Email Empresa</label>
                  <input type="text" class="form-control" id="email_empresa" name="email_empresa" placeholder="Ingresa email Empresa" value="{{ $empresa->email_empresa }}"  >
                </div>
                <div class="form-group">
                  <label for="serial">Contacto</label>
                  <input type="text" class="form-control text-uppercase" id="contacto" name="contacto" placeholder="Ingresa Contacto Empresa" value="{{ $empresa->contacto }}"  >
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