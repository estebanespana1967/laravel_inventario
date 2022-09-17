<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    use HasFactory;
     //Tabla
     protected $table = "receta";

     //columnas de uso masivo
     protected $fillable = [
         'numero_interno',
         'tipo_preparado',
         'paciente_id',
         'doctor_id',
         'fecha_receta',
         'fecha_recepcion',
         'cantidad_dias',
         'posologia_diaria',
         'serie',  
         'numero_controlado',  
         'rut_adquirente',
         'dv_adquirente',
         'nombre_completo_adquirente',
         'direccion_adquirente',
         'establecimiento',
         'rut_establecimiento',
         'dv_establecimiento',
         'cantidad_despachada',
         'director_tecnico',
         'rut_dt',
         'dv_dt',
         'fecha_entregado',
         'libro_numero',
         'tipo_receta'
         

     ];
     //Relacion: 1 receta tiene un medico (1 a 1), belongsto =pertenece a 1
    public function medico() {
        return $this->belongsTo(Medico::class,'doctor_id');
    }
     //Relacion: 1 receta tiene un paciente (1 a 1), belongsto =pertenece a 1
     public function paciente() {
        return $this->belongsTo(Paciente::class,'paciente_id');
    }
     //Relacion: 1 receta puede pertenece o tener muchas materias primas (1 a muchos), belongstomany =pertenece a muchos
    // return $this este modelo (receta) puede tener 1 o varias materias primas, y se relaciona a traves de la 
    // tabla intermedia preparado´, withPivot se colocan las columnas que queremeos mostrar de la tabla pivote/intermedia,
    // en este caso tabla preparado
    public function materia_primas()
    {
        return $this->belongsToMany(Materia_prima::class, 'preparado')->withPivot('cantidad_materia_prima','costo_materia_prima','id');
    }
    //Relacion: 1 receta tiene un paciente (1 a 1), belongsto =pertenece a 1
    public function cotizaciondetalle() {
        return $this->belongsTo(CotizacionDetalle::class,'numero_interno');
    }
}


