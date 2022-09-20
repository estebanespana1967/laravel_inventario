@extends('adminlte::page')

@section('title', 'EMPRESA')

@section('content_header')
    <h1>CREAR EMPRESA</h1>
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
            <form action="{{ route('empresas.store') }}" method="POST">
                @csrf
                  <div class="form-group">
                  <div class="form-group">
                  <label for="nombre">Tipo Empresa</label>
                  <input type="text" class="form-control text-uppercase" id="tipo_empresa" name="tipo_empresa" placeholder="Ingresa el tipo de empresa"  maxlength="28">
                </div>
                  <label for="nombre">Rut Empresa</label>
                  <input type="text" class="form-control" id="rut_empresa" name="rut_empresa" placeholder="Ingresa el rut de la empresa" >
                </div>
                <div class="form-group">
                  <label for="nombre">Dv Empresa</label>
                  <input type="text" class="form-control" id="dv_empresa" name="dv_empresa" placeholder="Ingresa el dv de la empresa" >
                </div>
                <script>
                var dv1 = document.getElementById('dv_empresa');
                
                dv1.addEventListener("blur",onRutBlur , false);
                 function onRutBlur() {
                  var rut = document.getElementById('rut_empresa');
                var dv = document.getElementById('dv_empresa');
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
                  <label for="nombre">Nombre Empresa</label>
                  <input type="text" class="form-control text-uppercase" id="nombre_empresa" name="nombre_empresa" placeholder="Ingresa el nombre de la empresa"  maxlength="28">
                </div>
                <div class="form-group">
                  <label for="nombre">Nombre Fantasia</label>
                  <input type="text" class="form-control text-uppercase" id="nombre_fantasia" name="nombre_fantasia" placeholder="Ingresa el nombre de la empresa"  maxlength="28">
                </div>
                <div class="form-group">
                  <label for="nombre">Giro Comercial</label>
                  <input type="text" class="form-control text-uppercase" id="giro_comercial" name="giro_comercial" placeholder="Ingresa el nombre de la empresa"  maxlength="28">
                </div>
                 <div class="form-group">
                  <label for="serial">Dirección Empresa</label>
                  <input type="text" class="form-control text-uppercase" id="direccion_empresa" name="direccion_empresa" placeholder="Ingresa la direccion de la empresa">
                </div>
                <div class="form-group">
                  <label for="serial">Comuna Empresa</label>
                  <input type="text" class="form-control text-uppercase" id="comuna_empresa" name="comuna_empresa" placeholder="Ingresa la comuna de la empresa">
                </div>
                <div class="form-group">
                  <label for="serial">Ciudad Empresa</label>
                  <input type="text" class="form-control text-uppercase" id="ciudad_empresa" name="ciudad_empresa" placeholder="Ingresa la ciudad de la empresa">
                </div>
                <div class="form-group">
                  <label for="serial">Teléfono Empresa</label>
                  <input type="text" class="form-control text-uppercase" id="telefono_empresa" name="telefono_empresa" placeholder="Ingresa el telefono de la empresa">
                </div>
                <div class="form-group">
                  <label for="serial">Email Empresa</label>
                  <input type="text" class="form-control" id="email_empresa" name="email_empresa" placeholder="Ingresa email Empresa">
                </div>
                <div class="form-group">
                  <label for="serial">Contacto</label>
                  <input type="text" class="form-control text-uppercase" id="contacto" name="contacto" placeholder="Ingresa Contacto Empresa">
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