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
            <form action="{{ route('entrada.encabezado.update', $entrada->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                  <label for="nombre">Tipo Documento</label>
                  <select class="form-control" name="tipo_documento">
                  @if ($entrada->tipo_documento==1)
                  <option value="1" selected>Factura</option>
                  <option value="2">Guia Despacho</option>
                  
                  @else
                  <option value="1" >Factura</option>
                  <option value="2" selected>Guia Despacho</option>
                  
                  @endif  
                  </select>
                </div>
                <div class="form-group">
                  <label for="nombre">Numero Documento</label>
                  <input type="text" class="form-control text-uppercase" id="numero_documento" name="numero_documento" placeholder="Ingresa el numero de documento"   value = "{{$entrada->numero_documento}}">
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre Empresa</label>
                  <select class="form-control" name="id_empresa">
                  <option selected disabled>Seleccionar</option>
                  @foreach ($empresas as $empresa)
                  @if($empresa->id==$entrada->id_empresa)
                  <option value="{{ $empresa->id}}" selected>{{ $empresa->nombre_empresa }}</option>
                  @else
                  <option value="{{ $empresa->id}}">{{ $empresa->nombre_empresa }}</option>
                  @endif
                  @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="nombre">Fecha Emision</label>
                  <input type="date" class="form-control text-uppercase" id="fecha_emision" name="fecha_emision" value="{{$entrada->fecha_emision}}" >
                </div>
                <div class="form-group">
                  <label for="nombre">Fecha Vencimiento</label>
                  <input type="date" class="form-control text-uppercase" id="fecha_vencimiento" name="fecha_vencimiento"  value="{{$entrada->fecha_vencimiento}}">
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre Responsable</label>
                  <select class="form-control" name="id_responsable">
                  <option selected disabled>Seleccionar</option>
                  @foreach ($responsables as $responsable)
                  @if($responsable->id==$entrada->id_responsable)
                  <option value="{{ $responsable->id}}" selected>{{ $responsable->nombre_apellido }}</option>
                  @else
                  <option value="{{ $responsable->id}}">{{ $responsable->nombre_apellido }}</option>
                  @endif
                  @endforeach
                  </select>
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