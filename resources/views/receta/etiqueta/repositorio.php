<p>Doctor: {{$receta[0]->medico->nombre_medico}}</p>
<p>Paciente: {{$receta[0]->paciente->nombre_completo}}</p>






<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif


<button type="button" onclick="javascript:imprSelec('eti1');">Imprimir</button>
<button type="button" onclick="javascript:imprSelec('prueba');">Imprimir</button>
<button type="button" onclick="javascript:imprSelec('eti3');">Imprimir</button>
<button type="button" onclick="javascript:imprSelec('eti4');">Imprimir</button>

<a href="javascript:imprSelec('eti2')" >Imprimir texto</a>

<div id="imp1">
    <h2>este es un div de prueba</h2>
</div>
<div class="container">
  <div class="row" id="prueba">
    <div class="col">
    <div id="eti1"> Ejemplo de etiqueta 1</div>
    </div>
    <div class="col" id="eti2">
     Ejemplo de etiqueta 2


     
    </div>
  </div>
  <div class="row">
    <div class="col" id="eti3">
     Ejemplo de etiqueta 3
    </div>
    <div class="col" id="eti4">
     Ejemplo de etiqueta 4
    </div>
  </div>
</div>
<p id="para">Cualquier texto acá</p>
   <button onclick="changeColor('blue');">Azul</button>
   <button onclick="changeColor('red');">Rojo</button>












@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
  
     function imprSelec(nombre) {
    var elem = document.getElementById('eti1');
    elem.style.color = 'white';
    
      var ficha = document.getElementById(nombre);
	  var ventimp = window.open(' ', 'popimpr');
	  ventimp.document.write( ficha.innerHTML );
	  ventimp.document.close();
	  ventimp.print( );
	  ventimp.close();
	}
  
        function changeColor(newColor) {
   var elem = document.getElementById('para');
   elem.style.color = newColor;
}
</script>

@stop