@extends('adminlte::page')

@section('title', 'RECETA')

@section('content_header')
    <h1>EDITAR RECETA</h1>
@stop
 

@section('content')
    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ route('receta.update', $receta->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                  <div class="form-group">
                  <label for="numero_interno">Número Cotización</label>
                  <input type="text" class="form-control" id="numero_interno" name="numero_interno" placeholder="Ingresa el numero interno"  value="{{ $receta->numero_interno }}" disabled >
                </div>
                <div class="form-group">
                  <label for="libro_numero">Libro-numero</label>
                  <input type="text" value="{{ $receta->libro_numero}}" class="form-control" id="libro_numero" name="libro_numero">
                </div>
                  <div class="form-group">
                  <label for="tipo_preparado">Tipo de preparado</label>
                  <input type="text" class="form-control" id="tipo_preparado" name="tipo_preparado" placeholder="tipo_preparado" value="{{ $receta->tipo_preparado }}" >
                </div>
                <div class="form-group">
                <label for="paciente_id">Nombre Paciente</label>
                  <select class="form-control" name="paciente_id">
                                                @foreach ($pacientes as $paciente)
                                                @if ($paciente->id == $receta->paciente_id)
                                            <option value="{{ $paciente->id}}"  selected disabled>{{ $paciente->nombre_completo }}</option>
                                            @endif
                                                   @endforeach
                                            </select>
                </div>
                <div class="form-group">
                  <label for="doctor_id">Nombre Doctor</label>
                  <select class="form-control" name="doctor_id">
                                                <option selected disabled>Seleccionar medico</option>
                                                @foreach ($medicos as $medico)
                                                @if ($medico->id == $receta->doctor_id)
                                            <option value="{{ $medico->id}}"  selected>{{ $medico->nombre_medico }}</option>
                                            @else
                                            <option value="{{ $medico->id}}">{{ $medico->nombre_medico }}</option>
                                            @endif
                                                @endforeach
                                            </select>

                </div>
                
                <div class="form-group">
                  <label for="fecha_receta">Fecha Receta</label>
                  <input type="date" class="form-control" id="fecha_receta"  name="fecha_receta" placeholder="Ingresa fecha receta"   value="{{ $receta->fecha_receta }}"  >
                </div>
                <div class="form-group">
                  <label for="fecha_recepcion">Fecha Recepción</label>
                  <input type="date" class="form-control" id="fecha_recepcion"  name="fecha_recepcion" placeholder="Ingresa fecha_recepcion"   value="{{ $receta->fecha_recepcion }}" >
                </div>
                <div class="form-group">
                  <label for="cantidad_dias">Cantidad dias tratamiento</label>
                  <input type="number" class="form-control" id="cantidad_dias" name="cantidad_dias" placeholder="Ingresa la cantidad de dias tratamiento"  value="{{ $receta->cantidad_dias }}" >
                </div>
                <div class="form-group">
                  <label for="posologia_diaria">Posología diaria</label>
                  <input type="number" class="form-control" id="posologia_diaria" name="posologia_diaria" placeholder="Ingresa posologia diaria"   value="{{ $receta->posologia_diaria }}" >
                </div>
                <div class="form-group">
                  <label for="serie">serie</label>
                  <input type="text" class="form-control" id="serie" name="serie" placeholder="Ingresa serie"  value="{{ $receta->serie }}" >
                </div>
                <div class="form-group">
                  <label for="numero_controlado">Número serie controlado</label>
                  <input type="text" class="form-control" id="numero_controlado" name="numero_controlado" placeholder="Ingresa numero_serie"  value="{{ $receta->numero_controlado }}" >
                </div>
                <div class="form-group">
                  <label for="rut_adquirente">Rut adquirente</label>
                  <input type="text" class="form-control" id="rut_adquirente" name="rut_adquirente" placeholder="Ingresa rut_adquirente"  value="{{ $receta->rut_adquirente }}" >
                </div>
                <div class="form-group">
                  <label for="dv_adquirente">dv Adquirente</label>
                  <input type="text" class="form-control" id="dv_adquirente" name="dv_adquirente" placeholder="Ingresa dv_adquirente"  value="{{ $receta->dv_adquirente }}" >
                </div>
                <div class="form-group">
                  <label for="nombre_completo_adquirente">Nombre completo adquirente</label>
                  <input type="text" class="form-control" id="nombre_completo_adquirente" name="nombre_completo_adquirente" placeholder="Ingresa nombre_completo_adquirente" value="{{ $receta->nombre_completo_adquirente }}">
                </div>
                <div class="form-group">
                  <label for="direccion_adquirente">Direccion Adquirente</label>
                  <input type="text" class="form-control" id="direccion_adquirente" name="direccion_adquirente" placeholder="Ingresa direccion_adquirente"  value="{{ $receta->direccion_adquirente }}">
                </div>
                <div class="form-group">
                  <label for="establecimiento">Establecimiento</label>
                  <input type="text" class="form-control" id="establecimiento" name="establecimiento" placeholder="Ingresa establecimiento"  value="{{ $receta->establecimiento }}">
                </div>
                <div class="form-group">
                  <label for="rut_establecimiento">Rut Establecimiento</label>
                  <input type="text" class="form-control" id="rut_establecimiento" name="rut_establecimiento" placeholder="Ingresa rut_establecimiento"  value="{{ $receta->rut_establecimiento }}">
                </div>
                <div class="form-group">
                  <label for="dv_establecimiento">dv Establecimiento</label>
                  <input type="text" class="form-control" id="dv_establecimiento" name="dv_establecimiento" placeholder="Ingresa dv_establecimiento" value="{{ $receta->dv_establecimiento }}">
                </div>
                <div class="form-group">
                  <label for="cantidad_despachada">Cantidad despachada(Caps/Gramos)</label>
                  <input type="text" class="form-control" id="cantidad_despachada" name="cantidad_despachada" placeholder="Ingresa cantidad_despachada" value="{{ $receta->cantidad_despachada }}">
                </div>
                <div class="form-group">
                  <label for="director_tecnico">Director Técnico</label>
                  <input type="text" class="form-control" id="director_tecnico" name="director_tecnico" placeholder="Ingresa director_tecnico" value="{{ $receta->director_tecnico }}">
                </div>
                <div class="form-group">
                  <label for="rut_dt">Rut dt</label>
                  <input type="text" class="form-control" id="rut_dt" name="rut_dt" placeholder="Ingresa rut_dt" value="{{ $receta->rut_dt }}">
                </div>
                <div class="form-group">
                  <label for="dv_dt">Dv dt</label>
                  <input type="text" class="form-control" id="dv_dt" name="dv_dt" placeholder="Ingresa dv_dt" value="{{ $receta->dv_dt }}">
                </div>
                <div class="form-group">
                  <label for="fecha_entregado">Fecha Entrega</label>
                  <input type="date" class="form-control" id="fecha_entregado" name="fecha_entregado" placeholder="Ingresa fecha entrega" value="{{ $receta->fecha_entregado }}">
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
 