<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
//Tabla
    protected $table = "productos";

    //columnas de uso masivo
    protected $fillable = [
        'descripcion',
        'cantidad'
    ];
}
