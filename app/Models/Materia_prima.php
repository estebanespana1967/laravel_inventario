<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Materia_prima;

class Materia_prima extends Model

{
    use HasFactory;
   //Tabla
    protected $table = "materia_prima";

    //columnas de uso masivo
    protected $fillable = [
        'nombre_mp',
        'fecha_venci',
        'lote',
        'serie',
        'proveedor',
        'costo',
        'venta',
        'stock',
        'controlado'
    ];   

 //Relacion: 1 receta puede pertenece o tener muchas materias primas (1 a muchos), belongstomany =pertenece a muchos
  
public function recetas()
    {
        return $this->belongsToMany(Receta::class, 'preparado');
    }
 //Relacion: 1 cotizacion_detalle puede pertenece o tener muchas materias primas (1 a muchos), belongstomany =pertenece a muchos
  
public function cotizacion_detalle()
{
    return $this->belongsToMany(CotizacionDetalle::class, 'cotizacion');
}
public function scopeNombre_mp($query, $nombre){
    if($nombre)
        return $query->where('nombre_mp','LIKE',"%$nombre%");
}
public function scopeFecha_venci($query, $nombre){
    if($nombre)
        return $query->where('fecha_venci','LIKE',"%$nombre%");
}
// relacion 1 a muchos, una materia prima puede estar en varios movimientos, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

public function movimiento()
{
    return $this->hasMany(Movimiento::class);
}
// relacion 1 a muchos, una materia prima puede estar en varios historial precios, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

public function historial_precios()
{
    return $this->hasMany(Historial_precio::class);
}
// relacion 1 a muchos, una materia prima puede estar en varios detalle entrada, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

public function detalle_entrada()
{
    return $this->hasMany(Detalle_entrada::class);
}
// relacion 1 a muchos, una materia prima puede estar en varios detalle entrada, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

public function detalle_salida()
{
    return $this->hasMany(Detalle_salida::class);
}

}