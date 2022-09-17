@foreach ($preparados as $preparado)
    
    <tr>
    <td>{{ $preparado->id }}</td>
    <td>{{ $preparado->materia_prima_id }}.materia primas</td>
    <td>{{ $preparado->cantidad_materia_prima }}</td>
    <td>{{ $preparado->costo_materia_prima }}</td>
    <td>{{$preparado->cantidad_materia_prima*$preparado->costo_materia_prima}}</td>
    <?php
    $resultado= ($resultado+($preparado->cantidad_materia_prima*$preparado->costo_materia_prima));
    $resultado=(int)($resultado);
    ?>
    <td>
<form action="{{ route('receta.preparadocapsula.destroyMateriaPrima',['preparado_id' => $preparado,'receta_id' => $receta]) }}" method="Post">
    <!-- <form action='{{ url("/receta/indexpreparadocapsula/{$preparado->id}/{$receta->id}") }}' method="Post">
 -->
 
 <a class="btn btn-primary" href="{{ route('receta.editMateriaPrima',['preparado_id' => $preparado,'receta_id' => $receta]) }}">Edit</a>

 @csrf
@method('DELETE')
<button type="submit" class="btn btn-danger">Borrar</button>
</form>
    </td>
    </tr>
    @endforeach
