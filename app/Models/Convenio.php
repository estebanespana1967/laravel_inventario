<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;
       //Tabla
       protected $table = "convenio";
 
       //columnas de uso masivo
       protected $fillable = [
           'nombre_convenio',
           ]; 
     //Relacion: 1 convenio puede tener 1 o varias cotizaciones, hasMany significa tiene muchos/varios
    // return $this significa este modelo
    public function cotizacion_detalle() {
        return $this->hasMany(CotizacionDetalle::class);  
    }    

    
}
