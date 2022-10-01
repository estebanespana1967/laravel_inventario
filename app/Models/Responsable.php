<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Responsable;

class Responsable extends Model
{
    use HasFactory;
   //Tabla
    protected $table = "responsable";

    //columnas de uso masivo
    protected $fillable = [
        'rut_responsable',
        'dv_responsable',
        'nombre_apellido',
        'cargo',
        
    ];   
     
//Funciones de búsqueda, Query Scope
public function scopeNombre($query, $nombre_apellido){
    if($nombre_apellido)
        return $query->where('nombre_apellido','LIKE',"%$nombre_apellido%");
}
public function scopeRut($query, $nombre_apellido){
    if($nombre_apellido)
        return $query->where('rut_responsable','LIKE',"%$nombre_apellido%");
}

public function encabezado_entrada()
{
    return $this->hasMany(Encabezado_entrada::class);
}


}

