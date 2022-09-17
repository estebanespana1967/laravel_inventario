<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaseCrema extends Model
{
    use HasFactory;
    //Tabla
    protected $table = "base_crema";
 
    //columnas de uso masivo
    protected $fillable = [
        'nombre_base_crema',
        'costo_base_crema',
        ]; 
 // relacion: 1 base crema puede o no estar en una cotizacion detalle, relacion 1 es a muchos, 
    // nombre de la tabla base_cotizacion es la tabla intermedia donde se une cotizacion detalle y base crema

    public function cotizacion_detalle()
    {
        return $this->belongsToMany(CotizacionDetalle::class, 'base_cotizacion');
    }

    }

