<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historial_precio extends Model
{
    use HasFactory;
    protected $table = "historial_precios";
    
    //columnas de uso masivo
    protected $fillable = [
        'id_materia_prima',
        'precio_neto',
        'precio_venta',
        'fecha_precio'
    ]; 
    // relacion 1 a muchos, una materia prima puede estar en varios historiales, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

public function materia_prima()
{
    return $this->belongsTo(Materia_prima::class, 'id_materia_prima');
}

}
