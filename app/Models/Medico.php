<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Medico;


class Medico extends Model
{
    use HasFactory;
   //Tabla
    protected $table = "medico";

    //columnas de uso masivo
    protected $fillable = [
        'rut_medico',
        'dv_medico',
        'nombre_medico',
        'telefono_medico',
        'direccion_medico',
        'email_medico',
        'especialidad'
    ];
    //Relacion: 1 medico puede tener 1 o varias recetas, hasMany significa tiene muchos/varios
    // return $this significa este modelo
    public function recetas() {
        return $this->hasMany(Receta::class);  
    }
    //Funciones de búsqueda, Query Scope
public function scopeNombre($query, $nombre){
    if($nombre)
        return $query->where('nombre_medico','LIKE',"%$nombre%");
}
public function scopeRut($query, $nombre){
    if($nombre)
        return $query->where('rut_medico','LIKE',"%$nombre%");
}
}
