@extends('adminlte::page')

@section('title', 'Seleccionar Posición')

@section('content_header')
    <h1>SELECCIONAR POSICION</h1>
@stop

@section('content')

<div class="row">
  <div class="col">
<?php
        
        $fecha_elaboracion= date("d/m/Y", strtotime($cotizacion->fecha_elaboracion));
        $fecha_vencimiento= date("d/m/Y", strtotime($cotizacion->fecha_vencimiento));
        $v_medico=utf8_decode($receta[0]->medico->nombre_medico);
?>
<table border=1   style="width: 600px">
           @if($cotizacion->tipo_cotizacion==1)
<tr>
<td>FF:Capsula. RM {{$receta[0]->numero_interno}} /2022</td>
</tr>
<tr>
<td>Dr: {{$v_medico}}</td>
</tr>
<tr>
<td>Pac: {{ $receta[0]->paciente->nombre_completo }}
</td>
</tr>
        @else 
<tr>
<td>FF:. {{$cotizacion->base_crema[0]->nombre_base_crema}} </td>
</tr>
<td>    Dr: {{$v_medico}}</td>
</tr>
<tr>
<td>Pac: {{ $receta[0]->paciente->nombre_completo }}
</td>
</tr>        
                 
            @endif

<?php
        
        if($cotizacion->tipo_cotizacion==1){
        $materiap="";
        $a=0;
        foreach ($cotizacion->materia_primas as $coti){
            $materiap=$materiap." ".$coti->nombre_mp; 
         
        if ($coti->pivot->cantidad_materia_prima > 1){
        $a=$a+1;
        }
        
        if ($a%2==0){
            
            $materiap=$materiap." ".$coti->pivot->cantidad_materia_prima." MG \n";
        }else{
            
            $materiap=$materiap." ".$coti->pivot->cantidad_materia_prima." MG ";
        }


        }
    

     //$v_paciente=utf8_decode($receta[0]->paciente->nombre_completo);  
     ?>

<tr>
<td>{{$materiap}}
</td>    
</tr>


      <?php
        
        } else {
                
        $materiap="";
        
        foreach ($cotizacion->materia_primas as $coti){
        $materiap=$materiap." ".$coti->nombre_mp; 
        $materiap=$materiap." ".$coti->pivot->cantidad_materia_prima." %, "; 
        }
        $v_paciente=utf8_decode($receta[0]->paciente->nombre_completo); 
        ?>
                <td>{{$materiap}}</td>
    <?php    
    } 
    ?>   
                                
        @if($cotizacion->tipo_cotizacion==1)
        <tr>
        <td>Fecha Elab {{$fecha_elaboracion}}</td>
        </tr>
        <tr>
        <td>Fecha Venci {{$fecha_vencimiento}}</td>
        </tr>
        <tr>
        <td>    
        CSP {{ $cotizacion->cantidad_capsulas}} CAPS
        </td>    
        </tr> 
        
        @else
        <tr>
        <td>Fecha Elab {{$fecha_elaboracion}}</td>
        </tr>
        <tr>
        <td>Fecha Venci {{$fecha_vencimiento}}</td>
        </tr>
        <tr>
            <td>
        CSP {{ $cotizacion->cantidad_capsulas}} GRS</td>
</tr> 
        
        @endif

<td>DOSIS {{ $receta[0]->posologia_diaria}} AL DIA</td>     
 <?php              
       $mensaje=utf8_decode("Mantener Fuera del alcance de los niños y conservar en lugar fresco y seco. Resolucion RF XIII 05/20 1A,1B, y 2C Farmavida. Nota: Eliminar este producto despues fecha vencimiento., Recoleta 5418, Huechuraba");
?>
</table>              
<table border=1 style="width: 600px">              

<tr><td>Mantener Fuera del alcance de los niños y conservar en lugar fresco y seco. </td></tr>
<tr><td>Resolucion RF XIII 05/20 1A,1B, y 2C Farmavida.</td></tr>
<tr><td>    Nota: Eliminar este producto despues fecha vencimiento., Recoleta 5418, Huechuraba</td></tr>     
</table>              
</div>
</div>
<div class="row">
        <div class="col-1"></div>
        <div class="col-10">
            <form action="{{ route('reporte.imprimiretiqueta',$cotizacion_id) }}" method="GET" target="_blank">
                @csrf
                  <div class="form-group">
                  <label for="posicion">posicion etiqueta</label>
                  <input type="text" class="form-control" id="posicion" name="posicion" placeholder="Ingresa posicion" >
                </div>
                <button type="submit" class="btn btn-primary" >Imprimir</button>
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