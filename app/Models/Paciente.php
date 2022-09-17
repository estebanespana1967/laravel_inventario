<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Paciente;


class Paciente extends Model
{
    use HasFactory;
   //Tabla
    protected $table = "paciente";

    //columnas de uso masivo
    protected $fillable = [
        'rut',
        'dv',
        'nombre_completo',
        'telefono',
        'direccion',
        'ciudad',
        'email'
        
    ];   
    //Relacion: 1 persona puede tener 1 o varias cotizaciones, hasMany significa tiene muchos/varios
    // return $this significa este modelo
    public function cotizacion_detalle() {
        return $this->hasMany(CotizacionDetalle::class);  
    }    
    //Relacion: 1 paciente puede tener 1 o varias recetas, hasMany significa tiene muchos/varios
    // return $this significa este modelo
    public function recetas() {
        return $this->hasMany(Receta::class);  
    } 
//Funciones de búsqueda, Query Scope
public function scopeNombre($query, $nombre){
    if($nombre)
        return $query->where('nombre_completo','LIKE',"%$nombre%");
}
public function scopeRut($query, $nombre){
    if($nombre)
        return $query->where('rut','LIKE',"%$nombre%");
}
}
