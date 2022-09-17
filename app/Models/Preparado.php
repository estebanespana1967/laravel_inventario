<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Preparado extends Model
{
    use HasFactory;
    //Tabla
     protected $table = "preparado";
 
     //columnas de uso masivo
     protected $fillable = [
         'receta_id',
         'materia_prima_id',
         'cantidad_materia_prima',
         'costo_materia_prima',
                 
     ];    
    
}
