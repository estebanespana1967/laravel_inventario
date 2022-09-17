@extends('adminlte::page')

@section('title', 'RECETA CHEQUE')

@section('content_header')
    <h1>CREAR RECETA CHEQUE</h1>
@stop

@section('content')
<h1>Receta Nuevo</h1>

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ route('receta.store') }}" method="POST">
                @csrf
                  <div class="form-group">
                  <label for="numero_interno">Numero cotización</label>
                  <input type="text" class="form-control" id="numero_interno" name="numero_interno" value="{{$cot_id}}">
                  <input type="hidden" value="cheque" class="form-control" id="tipo_receta" name="tipo_receta">
                </div>
                <div class="form-group">
                  <label for="libro_numero">Libro-numero</label>
                  <input type="text" value="" class="form-control" id="libro_numero" name="libro_numero">
                </div>
                  <div class="form-group">
                  <label for="tipo_preparado">Tipo de Preparado</label>
                  <select name="tipo_preparado"  class="form-control">
                <!--   <option selected disabled>Seleccionar</option> -->
                  <option value="controlado">Controlado</option>
                  <option value="no controlado">No controlado</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="paciente_id">Nombre del Paciente</label>
                  <input type="hidden" value="{{ $paciente->id}}" class="form-control" id="paciente_id" name="paciente_id">
                  <input type="text" value="{{ $paciente->nombre_completo}}" class="form-control" id="paciente_nombre" name="paciente_nombre">
                </div>
                <div class="form-group">
                  <label for="doctor_id">Médico</label>
                  <select class="form-control" name="doctor_id">
                  <option selected disabled>Seleccionar</option>
                  @foreach ($medicos as $medico)
                  <option value="{{ $medico->id}}">{{ $medico->nombre_medico }}</option>
                  @endforeach
                  </select>
                  
                  
                </div>

                <div class="form-group">
                  <label for="fecha_receta">Fecha Receta</label>
                  <input type="date" class="form-control" id="fecha_receta"  name="fecha_receta" placeholder="Ingresa fecha receta">
                </div>
                <?php
                  $DateAndTime = date('Y-m-d', time());
                   ?>
                <div class="form-group">
                  <label for="fecha_recepcion">Fecha Recepción</label>
                  <input type="date" class="form-control" id="fecha_recepcion"  name="fecha_recepcion" value = "{{ $DateAndTime }}">
                </div>
                
                <div class="form-group">
                  <label for="cantidad_dias">Cantidad dias tratamiento</label>
                  <input type="number" class="form-control" id="cantidad_dias" name="cantidad_dias" placeholder="Ingresa la cantidad de dias tratamiento">
                </div>
                <div class="form-group">
                  <label for="posologia_diaria">Posología Diaria</label>
                  <input type="number" class="form-control" id="posologia_diaria" name="posologia_diaria" placeholder="Ingresa posologia diaria">
                </div>
                <div class="form-group">
                  <label for="serie">Serie</label>
                  <input type="text" class="form-control" id="serie" name="serie" placeholder="Ingresa serie">
                </div>
                <div class="form-group">
                  <label for="numero_controlado">Número serie controlado</label>
                  <input type="text" class="form-control" id="numero_controlado" name="numero_controlado" placeholder="Ingresa numero_serie">
                </div>
                <div class="form-group">
                  <label for="rut_adquirente">Rut Adquirente</label>
                  <input type="text" class="form-control" value="{{ $paciente->rut}}" id="rut_adquirente" name="rut_adquirente">
                </div>
                <div class="form-group">
                  <label for="dv_adquirente">dv Adquirente</label>
                  <input type="text" class="form-control" value="{{ $paciente->dv}}" id="dv_adquirente" name="dv_adquirente">
                </div>
                <div class="form-group">
                  <label for="nombre_completo_adquirente">Nombre Completo Adquirente</label>
                  <input type="text" class="form-control" value="{{ $paciente->nombre_completo}}" id="nombre_completo_adquirente" name="nombre_completo_adquirente">
                </div>
                <div class="form-group">
                  <label for="direccion_adquirente">Dirección Adquirente</label>
                  <input type="text" class="form-control" value="{{ $paciente->direccion}}" id="direccion_adquirente" name="direccion_adquirente">
                </div>
                <div class="form-group">
                  <label for="establecimiento">Establecimiento</label>
                  <input type="text" class="form-control" id="establecimiento" name="establecimiento" value="FARMACIA FARMAVIDA">
                </div>
                <div class="form-group">
                  <label for="rut_establecimiento">Rut Establecimiento</label>
                  <input type="text" class="form-control" id="rut_establecimiento" name="rut_establecimiento" value="96.859.680">
                </div>
                <div class="form-group">
                  <label for="dv_establecimiento">dv Establecimiento</label>
                  <input type="text" class="form-control" id="dv_establecimiento" name="dv_establecimiento" value="2">
                </div>
                <div class="form-group">
                  <label for="cantidad_despachada">Cantidad despachada</label>
                  <input type="text" class="form-control" id="cantidad_despachada" name="cantidad_despachada" placeholder="Ingresa cantidad_despachada">
                </div>
                <div class="form-group">
                  <label for="director_tecnico">Director técnico</label>
                  <input type="text" class="form-control" id="director_tecnico" name="director_tecnico" value="NINOSKA FRANCO">
                </div>
                <div class="form-group">
                  <label for="rut_dt">Rut dt</label>
                  <input type="text" class="form-control" id="rut_dt" name="rut_dt" value="26.676.677">
                </div>
                <div class="form-group">
                  <label for="dv_dt">Dv dt</label>
                  <input type="text" class="form-control" id="dv_dt" name="dv_dt" value="0">
                </div>
                <script type="text/javascript">
  function confirma_grabar() 
  {
    var first = document.getElementById("fecha_recepcion").value;
var second = document.getElementById("fecha_receta").value;

 
var x = new Date(first);
var y = new Date(second);
 
// segundos = milisegundos/1000
// minutos = segundos/60
// horas = minutos/60
// Días = horas/24
 
const diffInDays = Math.floor((x - y) / (1000 * 60 * 60 * 24));
   
if (diffInDays >= 30)
{

return confirm('fecha recepcion mayor a 30 dias.¿Desea grabar este registro?');
}
   
  }
  </script>                
                <button type="submit" class="btn btn-primary" onclick="return confirma_grabar()">Crear</button>
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