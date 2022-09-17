<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;
    protected $table = "movimientos";
    
    //columnas de uso masivo
    protected $fillable = [
        'tipo_movimiento',
        'numero_documento',
        'rut_movimiento',
        'dv_documento',
        'rut_responsable',
        'dv_responsable',
        'motivo_movimiento',
        'id_materia_prima',
        'cantidad',
        'stock_final'
        ]; 
// relacion 1 a muchos, una materia prima puede estar en varios movimientos, y se colocoa en
//  el parentesis nombre de la columna que hace referencia

    public function materia_prima()
    {
        return $this->belongsTo(Materia_prima::class, 'id_materia_prima');
    }
 

}
