@extends('adminlte::page')

@section('title', 'COTIZACION')

@section('content_header')
    <h1>EDITAR COTIZACIÓN</h1>
@stop

@section('content')
<h1>EDITAR COTIZACION</h1>
    <div class="row">
        <div class="col-10">
        <form action="{{ route('cotizacioncapsula.update', $cotizacion->id) }}" method="POST">
                @csrf
                @method('PUT')
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
                  <input type="text" class="form-control" id="cantidad_capsulas" name="cantidad_capsulas" value="{{ $cotizacion->cantidad_capsulas }}">
                  </div>
                  <div class="form-group">
                  <label for="tipo_cotizacion">Tipo de cotización</label>
                  <select class="form-control" name="tipo_cotizacion">
                  @if ($cotizacion->tipo_cotizacion==1 )
                  <option value="1" selected>Cápsula</option>
                 @else
                  <option value="2" selected>Semi sólido</option>
                  @endif
                  </select>
                  </div>
                  <div class="form-group">
                  <label for="base_crema">Base crema</label>
                  @if ($cotizacion->tipo_cotizacion==1)
                  <select class="form-control" name="base_crema" disabled>
                  @else 
                  <select class="form-control" name="base_crema">
                  @foreach ($base_cremas as $base_crema)
                  @if ($cotizacion->base_crema[0]->pivot->base_crema_id==$base_crema->id )
                  <option value="{{ $base_crema->id}}" selected>{{ $base_crema->nombre_base_crema }}</option>
                  @else
                  <option value="{{ $base_crema->id}}">{{ $base_crema->nombre_base_crema }}</option>
                  @endif
                  @endforeach
  
                  @endif  
                  
                                    </select></div>
                  <div class="form-group">
                  <label for="convenio">Convenio</label>
                  <select class="form-control" name="convenio_id">
                  <option selected disabled>Seleccionar</option>
                  @foreach ($convenios as $convenio)
                  @if ($cotizacion->convenio_id==$convenio->id )
                  <option value="{{ $convenio->id}}" selected>{{ $convenio->nombre_convenio }}</option>
                  @else
                  <option value="{{ $convenio->id}}">{{ $convenio->nombre_convenio }}</option>
                  @endif
                  @endforeach
                  </select></div>
                  <div class="form-group">
                  <label for="responsable_entrega">Responsable entrega</label>
                  <input type="text" class="form-control" id="responsable_entrega" name="responsable_entrega"  value="{{ $cotizacion->responsable_entrega }}" >
                </div>
                <div class="form-group">
                  <label for="fecha_cotizacion">Fecha cotización</label>
                  <input type="date" class="form-control" id="fecha_cotizacion"  name="fecha_cotizacion" value="{{ $cotizacion->fecha_cotizacion }}">
                </div>
                
                <button type="submit" class="btn btn-primary">GUARDAR</button>
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