<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseCotizacion extends Model
{
    use HasFactory;
//Tabla
protected $table = "base_cotizacion";
 
//columnas de uso masivo
protected $fillable = [
    'cotizacion_detalle_id',
    'base_crema_id',
            
];    

}
