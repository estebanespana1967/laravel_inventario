<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Historial_precio;

class Historial_precio extends Model
{
    use HasFactory;
    protected $table = "historial_precios";
    
    //columnas de uso masivo
    protected $fillable = [
        'id_materia_prima',
        'precio_compra',
        'precio_venta',
        'fecha_precio',
        'id_detalle_entrada'
    ]; 
    // relacion 1 a muchos, una materia prima puede estar en varios historiales, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

public function materia_prima()
{
    return $this->belongsTo(Materia_prima::class, 'id_materia_prima');
}
public function scopeMateriaprima($query, $nombre){
    if($nombre){
    
        $id_mp=Materia_prima::where('nombre_mp','LIKE',"%$nombre%")->select('id')->get();

        return $query->whereIn('id_materia_prima',$id_mp);
    }

}
public function scopeFechaPrecio($query, $nombre){
    if($nombre){
        $id_mp=Materia_prima::where('nombre_mp','LIKE',"%$nombre%")->select('id')->get();

        $ultimo_registro = Historial_precio::whereIn('id_materia_prima',$id_mp)->
        orderBy('id', 'desc')->first();
        return $ultimo_registro;
    }
}

}
