@extends('adminlte::page')

@section('title', 'RESPONSABLE')

@section('content_header')
    <h1>CREAR RESPONSABLE</h1>
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
            <form action="{{ route('responsable.store') }}" method="POST">
                @csrf
                  <div class="form-group">
                  <label for="nombre">Rut responsable</label>
                  <input type="text" class="form-control" id="rut_responsable" name="rut_responsable" placeholder="Ingresa el rut del responsable" >
                </div>
                <div class="form-group">
                  <label for="nombre">dv</label>
                  <input type="text" class="form-control" id="dv_responsable" name="dv_responsable" placeholder="Ingresa el dv del responsable" >
                </div>
                <script>
                var dv1 = document.getElementById('dv_responsable');
                
                dv1.addEventListener("blur",onRutBlur , false);
                 function onRutBlur() {
                  var rut = document.getElementById('rut_responsable');
                var dv = document.getElementById('dv_responsable');
                var obj = rut.value + '-' + dv.value;
                                
                          if (VerificaRut(obj)){
                          alert("Rut correcto");  
                         
                          }
                          else 
                          {
                            rut.value="";
                            dv.value="";
                            rut.focus();
                            alert("Rut incorrecto");
                          }
                            
                        }
                    </script>  
         
                <div class="form-group">
                  <label for="nombre">Nombre Apellido</label>
                  <input type="text" class="form-control text-uppercase" id="nombre_apellido" name="nombre_apellido" placeholder="Ingresa el nombre y apellido del responsable"  maxlength="28">
                </div>
                <div class="form-group">
                  <label for="descripcion">Cargo</label>
                  <input type="text" class="form-control" id="cargo"  name="cargo" placeholder="Ingresa el cargo">
                </div>
                <button type="submit" class="btn btn-primary" >Crear Responsable</button>
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