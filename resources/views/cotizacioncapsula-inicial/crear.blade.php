@extends('adminlte::page')

@section('title', 'AGREGAR MATERIA PRIMA')

@section('content_header')
    <h1>AGREGAR MATERIA PRIMA</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ route('receta.storeMateriaPrima') }}" method="POST">
                @csrf
                  <div class="form-group">
                  <label for="numero_interno">Numero Receta</label>
                  <input type="text" class="form-control" id="receta_id" name="receta_id" value="{{ $receta->id}}" >
                </div>
                  
                
                <div class="form-group">
                  <label for="materia_prima_id">Materia prima</label>
                  <select class="form-control" name="materia_prima_id">
                  <option selected disabled>Seleccionar</option>
                  @foreach ($materia_primas as $materia_prima)
                  <option value="{{ $materia_prima->id}}">{{ $materia_prima->nombre_mp }}</option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="cantidad_mp">Cantidad materia prima</label>
                  <input type="text" class="form-control" id="cantidad_mp" name="cantidad_mp" placeholder="cantidad materia prima">
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