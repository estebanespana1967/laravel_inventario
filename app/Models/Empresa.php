<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    //Tabla
    protected $table = "empresas";
 
    //columnas de uso masivo
    protected $fillable = [
        
        'tipo_empresa',
        'rut_empresa',
        'dv_empresa',
        'nombre_empresa',
        'nombre_fantasia',
        'giro_comercial',
        'direccion_empresa',
        'comuna_empresa',
        'ciudad_empresa',
        'telefono_empresa',
        'email_empresa',
        'contacto'
    ]; 
    // relacion 1 a muchos, una empresa puede estar en varios encabezados, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

public function encabezado_entrada()
{
    return $this->hasMany(Encabezado_entrada::class);
}
public function encabezado_salida()
{
    return $this->hasMany(Encabezado_salida::class);
}
}
