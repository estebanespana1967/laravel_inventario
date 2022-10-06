<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;
    //Tabla
    protected $table = "cotizacion";
 
    //columnas de uso masivo
    protected $fillable = [
        'cotizacion_detalle_id',
        'materia_prima_id',
        'cantidad_materia_prima',
        'costo_materia_prima',
        'id_detalle_entrada',
    ];    
    // relacion  de 1 a 1
    public function materia_prima_cotizacion() {
        return $this->belongsTo(Materia_prima::class,'materia_prima_id');

    }
    public function cotizacion_detalle() {
        return $this->belongsTo(CotizacionDetalle::class,'cotizacion_detalle_id');
    }
    public function detalle_entrada() {
        return $this->belongsTo(Detalle_entrada::class,'id_detalle_entrada');
    }


}
