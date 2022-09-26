@extends('adminlte::page')

@section('title', 'SALIDA')

@section('content_header')
    <h1>CREAR SALIDA</h1>
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
            <form action="{{ route('salida.encabezado.store') }}" method="POST">
                @csrf
                  <div class="form-group">
                  <label for="nombre">Tipo Documento</label>
                  <select class="form-control" name="tipo_documento">
                  <option value="1" selected>Factura</option>
                  <option value="2">Guia Despacho</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="nombre">Numero Documento</label>
                  <input type="text" class="form-control text-uppercase" id="numero_documento" name="numero_documento" placeholder="Ingresa el numero de documento"  maxlength="28">
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre Empresa</label>
                  <select class="form-control" name="id_empresa">
                  <option selected disabled>Seleccionar</option>
                  @foreach ($empresas as $empresa)
                  <option value="{{ $empresa->id}}">{{ $empresa->nombre_empresa }}</option>
                  @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="nombre">Fecha Emision</label>
                  <input type="date" class="form-control text-uppercase" id="fecha_emision" name="fecha_emision" >
                </div>
                <div class="form-group">
                  <label for="nombre">Fecha Vencimiento</label>
                  <input type="date" class="form-control text-uppercase" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="Ingresa la fecha vencimiento"  maxlength="28">
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    function VerificaRut(rut) {
    if (rut.toString().trim() != '' && rut.toString().indexOf('-') > 0) {
        var caracteres = new Array();
        var serie = new Array(2, 3, 4, 5, 6, 7);
        var dig = rut.toString().substr(rut.toString().length - 1, 1);
        rut = rut.toString().substr(0, rut.toString().length - 2);

        for (var i = 0; i < rut.length; i++) {
            caracteres[i] = parseInt(rut.charAt((rut.length - (i + 1))));
        }

        var sumatoria = 0;
        var k = 0;
        var resto = 0;

        for (var j = 0; j < caracteres.length; j++) {
            if (k == 6) {
                k = 0;
            }
            sumatoria += parseInt(caracteres[j]) * parseInt(serie[k]);
            k++;
        }

        resto = sumatoria % 11;
        dv = 11 - resto;

        if (dv == 10) {
            dv = "K";
        }
        else if (dv == 11) {
            dv = 0;
        }

        if (dv.toString().trim().toUpperCase() == dig.toString().trim().toUpperCase())
            return true;
        else
            return false;
    }
    else {
        return false;
    }
}   
</script> 
@stop