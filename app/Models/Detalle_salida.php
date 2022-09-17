<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_salida extends Model
{
    use HasFactory;
    //Tabla
    protected $table = "detalle_salida";
 
    //columnas de uso masivo
    protected $fillable = [
       'id_encabezado_salida',
       'id_materia_prima',
       'cantidad_materia_prima',
       'unidad_medida',
       'costo',
       'serie',
       'lote',
       'fecha_vencimiento',
       ];
       // relacion 1 a muchos, una materia prima puede estar en varios detalle salida, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

    public function materia_prima()
    {
        return $this->belongsTo(Materia_prima::class, 'id_materia_prima');
    }
// relacion 1 a muchos, un detalle puede estar en 1 encabezado, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

public function encabezado_salida()
{
    return $this->belongsTo(Encabezado_salida::class, 'id_encabezado_salida');
}
}
