@extends('adminlte::page')

@section('title', 'COTIZACION')

@section('content_header')
    <h1>CREAR COTIZACIÓN</h1>
@stop

@section('content')
<h1>Receta Nueva</h1>
    <div class="row">
        <div class="col-10">
            <form action="{{ route('cotizacioncapsula.store') }}" method="POST">
                @csrf
                  <div class="form-group">
                  <label for="paciente_id">id paciente</label>
                  <input type="text" class="form-control" id="paciente_id" name="paciente_id"  value="{{ $paciente->id }}"  readonly>
                </div>
                <div class="form-group">
                  <label for="nombre_completo">Nombre Completo</label>
                  <input type="text" class="form-control" id="nombre_completo" name="nombre_completo" value="{{ $paciente->nombre_completo }}" >
                </div>
                  <div class="form-group">
                  <label for="cantidad_capsulas">Cantidad de Cápsulas/Semisolidos</label>
                  <input type="number" class="form-control" id="cantidad_capsulas" name="cantidad_capsulas" placeholder="Ingresa cantidad de Cápsulas/Semisolidos">
                  </div>
                  <div class="form-group">
                  <label for="tipo_cotizacion">Tipo de Cotización</label>
                  <select class="form-control" name="tipo_cotizacion">
                  <option selected disabled>Seleccionar</option>
                  <option value="1" >Cápsula</option>
                  <option value="2">Semi sólido</option>
                  </select>
                  </div>
                  <div class="form-group">
                  <label for="base_crema">Base crema</label>
                  <select class="form-control" name="base_crema">
                  <option selected disabled>Seleccionar</option>
                  @foreach ($base_cremas as $base_crema)
                  <option value="{{ $base_crema->id}}">{{ $base_crema->nombre_base_crema }}</option>
                  @endforeach
                  </select></div>
                  <div class="form-group">
                  <label for="convenio">Convenio</label>
                  <select class="form-control" name="convenio_id">
                  <option selected disabled>Seleccionar</option>
                  @foreach ($convenios as $convenio)
                  <option value="{{ $convenio->id}}">{{ $convenio->nombre_convenio }}</option>
                  @endforeach
                  </select></div>
                  <div class="form-group">
                  <label for="responsable_entrega">Responsable entrega</label>
                  <input type="text" class="form-control" id="responsable_entrega" name="responsable_entrega" >
                </div>
                <div class="form-group">
                  <label for="fecha_cotizacion">Fecha cotización</label>
                  <?php
                  /* $date = Carbon::now(); */
                  $DateAndTime = date('Y-m-d', time());
                   ?>
                  <input type="date" class="form-control" id="fecha_cotizacion"  name="fecha_cotizacion" value = "{{ $DateAndTime }}" >
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