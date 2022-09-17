@extends('adminlte::page')

@section('title', 'EDITAR MATERIA PRIMA')

@section('content_header')
    <h1>EDITAR MATERIA PRIMA</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ route('cotizacioncapsula.actualizarMPSS', $cotizacion->id) }}" method="POST">
                @csrf
                @method('PUT')
                  <div class="form-group">
                  <label for="numero_interno">Número cotización</label>
                  <input type="text" class="form-control" id="cotizacion_detalle_id" name="cotizacion_detalle_id" value="{{ $cotizacion->cotizacion_detalle_id}}" >
                </div>
                  
                
                <div class="form-group">
                  <label for="materia_prima_id">Materia prima</label>
                  
                  <select class="form-control" name="materia_prima_id">
                  <option selected disabled>Seleccionar</option>
                  @foreach ($materia_primas as $materia_prima)
                  @if ($materia_prima->id == $cotizacion->materia_prima_id)
                   <option value="{{ $materia_prima->id}}" selected>{{ $materia_prima->nombre_mp }}</option>
                  @else
                  <option value="{{ $materia_prima->id}}">{{ $materia_prima->nombre_mp }}</option>
                  @endif
                  @endforeach
  
                </select>
                </div>
                <div class="form-group">
                  <label for="cantidad_mp">Cantidad materia prima</label>
                  <input type="text" class="form-control" value="{{$cotizacion->cantidad_materia_prima}}" id="cantidad_mp" name="cantidad_mp" placeholder="cantidad materia prima">
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
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