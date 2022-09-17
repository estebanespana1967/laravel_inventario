<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encabezado_salida extends Model
{
    use HasFactory;
    protected $table = "encabezado_salida";
    
    //columnas de uso masivo
    protected $fillable = [
        'tipo_documento',
        'numero_documento',
        'id_empresa',
        'fecha_emision',
        'fecha_vencimiento',
    ]; 
    // relacion 1 a muchos, una empresa puede estar en 1 o varios encabezados, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

public function empresa()
{
    return $this->belongsTo(Empresa::class, 'id_empresa');
}

// relacion 1 a muchos, una  puede estar encabezado entrada en varios detalle salida, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

public function detalle_salida()
{
    return $this->hasMany(Detalle_salida::class);
}

}
