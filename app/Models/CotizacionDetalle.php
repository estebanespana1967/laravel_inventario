<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CotizacionDetalle extends Model
{
    use HasFactory;
    //Tabla
    protected $table = "cotizacion_detalle";
 
    //columnas de uso masivo
    protected $fillable = [
        'paciente_id',
        'cantidad_capsulas',
        'tipo_cotizacion',
        'convenio_id',
        'fecha_cotizacion',
        'fecha_elaboracion',
        'fecha_vencimiento',
        'estado',
        'responsable_entrega',
        'valor',
    ];    
     //Relacion: 1 cotizacion puede pertenece o tener muchas materias primas (1 a muchos), belongstomany =pertenece a muchos
    // return $this este modelo (receta) puede tener 1 o varias materias primas, y se relaciona a traves de la 
    // tabla intermedia preparado´, withPivot se colocan las columnas que queremeos mostrar de la tabla pivote/intermedia,
    // en este caso tabla preparado
    public function materia_primas()
    {
        return $this->belongsToMany(Materia_prima::class, 'cotizacion')->withPivot('cantidad_materia_prima','costo_materia_prima','id');
    }
    // relacion: 1 cotizacion_detalle puede o no tener una base crema, relacion 1 es a muchos, 
    // nombre de la tabla base_cotizacion es la tabla intermedia donde se une cotizacion detalle y base crema

    public function base_crema()
    {
        return $this->belongsToMany(BaseCrema::class, 'base_cotizacion');
    }
    //Relacion: 1 cotizacion detalle pertenece a una persona (1 a 1), belongsto =pertenece a 1
    
    public function paciente() {
        return $this->belongsTo(Paciente::class,'paciente_id');
    }
    //Relacion: 1 cotizacion detalle pertenece a una convenio (1 a 1), belongsto =pertenece a 1
    
    public function convenio() {
        return $this->belongsTo(Convenio::class,'convenio_id');
    }

    public function receta() {
        return $this->hasOne(Receta::class,'numero_interno');  
    } 

    public function cotizacion() {
        return $this->hasMany(Cotizacion::class);  
    } 


    
}
