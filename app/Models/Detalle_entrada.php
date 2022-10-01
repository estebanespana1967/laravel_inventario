<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_entrada extends Model
{
    use HasFactory;
     //Tabla
     protected $table = "detalle_entrada";
 
     //columnas de uso masivo
     protected $fillable = [
        'id_encabezado_entrada',
        'id_materia_prima',
        'cantidad_materia_prima',
        'unidad_medida',
        'costo',
        'serie',
        'lote',
        'fecha_vencimiento',
        'status_mp',
        'stock_mp'
     ];
        // relacion 1 a muchos, una materia prima puede estar en varios detalle entrada, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

    public function materia_prima()
    {
        return $this->belongsTo(Materia_prima::class, 'id_materia_prima');
    }
    // relacion 1 a muchos, un detalle puede estar en 1 encabezados, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

public function encabezado_entrada()
{
    return $this->belongsTo(Encabezado_entrada::class, 'id_encabezado_entrada');
}

}
