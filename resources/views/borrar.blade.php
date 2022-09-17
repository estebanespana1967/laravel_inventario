@extends('layouts.app')

@section('content')

    <div class="container px-4 px-lg-5 bg-secondary">

        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">

        </div>
        <!-- Call to Action-->

        <!-- Content Row-->
        <div class="row gx-4 gx-lg-5">
            <div class="row">
                <div class="col">
                    <script>
                        function onRutBlur(obj) {
                            if (VerificaRut(obj.value))
                                alert("Rut correcto");
                            else
                                obj.value="";
                                alert("Rut incorrecto");
                        }
                    </script>
                    Ingrese RUT: <input type="text" id="txtRut" onblur="onRutBlur(this);" />
                    <p></p>
                </div>
            </div>
        </div>
    </div>
@endsection

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
