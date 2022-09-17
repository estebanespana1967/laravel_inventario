<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    //Tabla
    protected $table = "persona";

    //columnas de uso masivo
    protected $fillable = [
        'rut',
        'dv',
        'nombre_completo',
        'telefono',
        'direccion',
        'email'
        
    ]; 
    //Relacion: 1 persona puede tener 1 o varias cotizaciones, hasMany significa tiene muchos/varios
    // return $this significa este modelo
    public function cotizacion_detalle() {
        return $this->hasMany(CotizacionDetalle::class);  
    }    
}
