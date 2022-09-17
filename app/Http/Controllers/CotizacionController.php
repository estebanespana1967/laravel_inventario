<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Cotizacion;
use App\Models\CotizacionDetalle;
use App\Models\Receta;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Preparado;
use App\Models\Materia_prima;
use App\Models\Persona;
use App\Models\BaseCrema;
use App\Models\BaseCotizacion;
use App\Models\Convenio;

use Carbon\Carbon;




class CotizacionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($paciente_id)
    {
        $paciente = Paciente::find($paciente_id);
        $cotizaciones=CotizacionDetalle::where('paciente_id',$paciente_id)
                                        ->orderBy('id', 'desc')
                                        ->paginate(5);
        return view('cotizacioncapsula.index', compact('paciente','cotizaciones'));
    }

    public function showCotizaciones($id)
    {
        $persona = Persona::find($id);
        $cotizaciones=Cotizacion::where('persona_id',$id)->get();
        /* dd($recetas); */
        return view('cotizacioncapsula.showCotizaciones', compact('persona','cotizaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($paciente_id)
    {
        $paciente=Paciente::find($paciente_id);
        $base_cremas=BaseCrema::all();
        $convenios=Convenio::all();
        
        return view('cotizacioncapsula.crear', compact('paciente','base_cremas','convenios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cotizacion = new CotizacionDetalle();

        $paciente_id=$request->paciente_id;
              
        $cotizacion->paciente_id = $request->paciente_id;
        $cotizacion->cantidad_capsulas = $request->cantidad_capsulas;
        $cotizacion->tipo_cotizacion= $request->tipo_cotizacion;
        $cotizacion->convenio_id= $request->convenio_id;
        $cotizacion->responsable_entrega= $request->responsable_entrega;
       
        $cotizacion->fecha_cotizacion= $request->fecha_cotizacion;
        $cotizacion->fecha_elaboracion= $request->fecha_cotizacion;
     
        $mifecha = $cotizacion->fecha_elaboracion;
        $currentDateTime = Carbon::parse($mifecha);
        $newDateTime = ($currentDateTime->addDays(45))->format('Y-m-d');
           $cotizacion->fecha_vencimiento= $newDateTime;

               
$cotizacion->estado = "COTIZADO";

        $cotizacion->save();//Guarda la informaci'on en la tabla producto de la base de datos
        if ($cotizacion->tipo_cotizacion == 2){
           $base_cotizacion=new BaseCotizacion();
           $base_cotizacion->cotizacion_detalle_id=$cotizacion->id;
           $base_cotizacion->base_crema_id=$request->base_crema;
           $base_cotizacion->save();
           $cotizacion_id = $cotizacion->id;
           return redirect()->route('cotizacioncapsula.detalle_semisolido.index',$cotizacion_id);  
        }

        $cotizacion_id = $cotizacion->id;
         return redirect()->route('cotizacioncapsula.detalle_capsula.index',$cotizacion_id);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $base_cremas=BaseCrema::all();
        $convenios=Convenio::all();
        $cotizacion=CotizacionDetalle::find($id);
        $paciente=Paciente::find($cotizacion->paciente_id);
        return view('cotizacioncapsula.editar', compact('cotizacion','paciente','base_cremas','convenios'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
    {
         $cotizacion = CotizacionDetalle::find($id);
         

        $paciente_id=$request->paciente_id;
          
        $cotizacion->paciente_id = $request->paciente_id;
        $cotizacion->cantidad_capsulas = $request->cantidad_capsulas;
        $cotizacion->tipo_cotizacion= $request->tipo_cotizacion;
        $cotizacion->convenio_id= $request->convenio_id;
        $cotizacion->responsable_entrega= $request->responsable_entrega;
        $cotizacion->fecha_cotizacion= $request->fecha_cotizacion;

        
        
        $cotizacion->save();//Guarda la informaci'on en la tabla producto de la base de datos
         if ($cotizacion->tipo_cotizacion == 2){
            $cotizacion->base_crema()->sync($request->base_crema);
        }
 

         return redirect()->route('cotizacioncapsula.index',$paciente_id);

    }
    
    public function updateEstadoCapsula(Request $request,  $id)
    {
            $cotizacion = CotizacionDetalle::find($id);            
            $cotizacion->estado = 'PRODUCCION';
            $cotizacion->save();//Guarda la informaci'on en la tabla producto de la base de datos
            $cotizaciones=CotizacionDetalle::orderBy('id', 'desc')->get();
           
            // $pa_id (nombre variable ), $cotizacion (nombre modelo o tabla), paciente_id (nombre campo)
            $pa_id=$cotizacion->paciente_id;
            $cot_id=$cotizacion->id;
            $paciente = Paciente::find($pa_id);
            
             $tipo_rec=$request->tipo_receta;
             if ($tipo_rec=="cheque"){
               return redirect('/receta/crearcot/' . $pa_id . '/' . $cot_id);

             } else {
                return redirect('/receta/createBlancacot/' . $pa_id . '/' . $cot_id);
             }

   
    }
/* Esto es nuevo 17-07 */
    public function updateEstadoSemisolido(Request $request,  $id)
    {
            $cotizacion = CotizacionDetalle::find($id);            
            $cotizacion->estado = 'PRODUCCION';
            $cotizacion->save();//Guarda la informaci'on en la tabla producto de la base de datos
            $cotizaciones=CotizacionDetalle::orderBy('id', 'desc')->get();
            // $pa_id (nombre variable ), $cotizacion (nombre modelo o tabla), paciente_id (nombre campo)
            $pa_id=$cotizacion->paciente_id;
            $cot_id=$cotizacion->id;
            $paciente = Paciente::find($pa_id);
            $tipo_rec=$request->tipo_receta;
             if ($tipo_rec=="cheque"){
               return redirect('/receta/crearcot/' . $pa_id . '/' . $cot_id);

             } else {
                return redirect('/receta/createBlancacot/' . $pa_id . '/' . $cot_id);
             }


            /* return redirect()->route('cotizacioncapsula.detalle_semisolido.index', compact('id')); */
                
    }




    public function indexcotizacioncapsula($id)
    {
    
        $cotizacion_detalle=CotizacionDetalle::find($id);
        $paciente=Paciente::find($cotizacion_detalle->paciente_id);
       /*  dd($persona); */
       $cotizaciones=Cotizacion::where('cotizacion_detalle_id',$id)->get();
               
$valor_gramomp=0;
        foreach ($cotizaciones as $cotizacion){
        $valor_gramomp= ($valor_gramomp+($cotizacion->cantidad_materia_prima*$cotizacion->costo_materia_prima));
         }
        /* 50 es el valor de la capsula */
         $valorgramototal=$valor_gramomp+50;
         $valortotal=$valorgramototal*$cotizacion_detalle->cantidad_capsulas;
         /*  dd($valortortal); */
         $valortotal=round($valortotal*0.01)*100; 
        $cotizacion_detalle->valor=$valortotal;
        $cotizacion_detalle->save(); 
        $cotizacion_existe=Receta::where('numero_interno',$id)->select('id')->get(); 
      /*   dd($cotizacion_existe); */


        return view('cotizacioncapsula.detalle_capsula.index', compact('cotizacion_existe','paciente','cotizaciones','cotizacion_detalle'));

        }
    

    public function indexcotizacionsemisolido($id)
    {
    
        /* $cotizacion=Cotizacion::find($id); */
       /* dd($id); */
        $cotizacion_detalle=CotizacionDetalle::find($id);
        $paciente=Paciente::find($cotizacion_detalle->paciente_id);
       /*  dd($persona); */

        $cotizaciones=Cotizacion::where('cotizacion_detalle_id',$id)->get();
        $valor_gramomp=0;
        foreach ($cotizaciones as $cotizacion){
        $valor_gramomp= ($valor_gramomp+($cotizacion->cantidad_materia_prima*$cotizacion->costo_materia_prima));
         }
         $valorgramototal=$valor_gramomp+$cotizacion_detalle->base_crema[0]->costo_base_crema;
         $valortotal=$valorgramototal*$cotizacion_detalle->cantidad_capsulas;
         $valortotal=round($valortotal*0.01)*100; 
        $cotizacion_detalle->valor=$valortotal;
        $cotizacion_detalle->save(); 
        $cotizacion_existe=Receta::where('numero_interno',$id)->select('id')->get(); 
        /* dd($valortortal); */
        return view('cotizacioncapsula.detalle_semisolido.index', compact('cotizacion_existe','paciente','cotizaciones','cotizacion_detalle'));


    }


    public function elegircotizacion($id)
    {
    
        $cotizacion_detalle=CotizacionDetalle::find($id);
        /* dd($cotizacion_detalle); */
        $paciente=Paciente::find($cotizacion_detalle->paciente_id);
       /*  dd($persona); */
        $cotizaciones=Cotizacion::where('cotizacion_detalle_id',$id)->get();
        /* dd($preparados); */
        if ($cotizacion_detalle->estado=="PRODUCCION" or $cotizacion_detalle->estado=="TERMINADO" or $cotizacion_detalle->estado=="ENTREGADO") {
            return redirect()->route('ver_index', compact('id'));
        } else {
           
            if ($cotizacion_detalle->tipo_cotizacion ==1){
                return redirect()->route('cotizacioncapsula.detalle_capsula.index', [$id]);
                } else {
                return redirect()->route('cotizacioncapsula.detalle_semisolido.index', [$id]);
               }
        }
        
        
        
    }

    public function ver_index($id)
    {
    
       
        $cotizacion_detalle=CotizacionDetalle::find($id);
        $cotizacion_existe=Receta::where('numero_interno',$id)->select('id')->get(); 
        $paciente=Paciente::find($cotizacion_detalle->paciente_id);
        $cotizaciones=Cotizacion::where('cotizacion_detalle_id',$id)->get();
        if ($cotizacion_detalle->tipo_cotizacion ==1){
        return view('cotizacioncapsula.detalle_capsula.ver_index', compact('paciente','cotizaciones','cotizacion_detalle'));
        } else {
        return view('cotizacioncapsula.detalle_semisolido.ver_index', compact('paciente','cotizaciones','cotizacion_detalle'));
        }
        
    }
    public function crearMateriaPrima($cotizacion_id)
    {
        $cotizacion=CotizacionDetalle::find($cotizacion_id);
        $materia_primas=Materia_prima::all();
        return view('cotizacioncapsula.detalle_capsula.crear', compact('cotizacion','materia_primas'));
        
    }



    public function guardarMateriaPrima(Request $request)
    {
        $cot=Cotizacion::where('cotizacion_detalle_id' ,$request->cotizacion_detalle_id)
        ->where('materia_prima_id',$request->materia_prima_id)->get(); 
        
        if ($cot->isEmpty()) {
            
               
         $cotizacion = new Cotizacion();
         $materia_prima=Materia_prima::find($request->materia_prima_id);
         /* dd($materia_prima); */
         $cotizacion->cotizacion_detalle_id= $request->cotizacion_detalle_id;
         $cotizacion->materia_prima_id= $request->materia_prima_id;
         $cotizacion->cantidad_materia_prima= $request->cantidad_mp;
         $cotizacion->costo_materia_prima= $materia_prima->venta;
         
        $cotizacion->save();//Guarda la informaci'on en la tabla producto de la base de datos
        
        
        
    } 
    
    $id=$request->cotizacion_detalle_id;
      return redirect()->route('elegircotizacion', compact('id'));
           
           
    }

    public function update1(Request $request, $id)
    {
        $cotizacion = Cotizacion::find($id);
        $cotizacion->update($request->all());
        return redirect()->route('cotizacioncapsula.historial',$cotizacion->persona_id);
    } 


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cotizacion = CotizacionDetalle::find($id);
        $persona_id=$cotizacion->persona_id;
        $cotizacion->delete();
        return redirect()->route('cotizacioncapsula.index', compact('persona_id'));
    }
    public function eliminarMateriaPrima($cotizacion_id)
    {
     /*    dd($preparado_id); */
        
        $cotizacion = Cotizacion::find($cotizacion_id);
       /*  dd($cotizacion); */
        $cotizacion->delete();
        $id=$cotizacion->cotizacion_detalle_id;
        return redirect()->route('elegircotizacion', compact('id'));
    }
    public function eliminarMateriaPrimaSS($cotizacion_id)
    {
     /*    dd($preparado_id); */
        
        $cotizacion = Cotizacion::find($cotizacion_id);
        $cotizacion->delete();
        $id=$cotizacion->cotizacion_detalle_id;
        return redirect()->route('elegircotizacion', compact('id'));
        }
    
        public function editarMateriaPrima($cotizacion_id)
    {
        $cotizacion=Cotizacion::find($cotizacion_id);
        $materia_primas=Materia_prima::all();
        return view('cotizacioncapsula.detalle_capsula.editar', compact('cotizacion','materia_primas'));
    }
    public function actualizarMP(Request $request, $cotizacion_id)
    {
         $cotizacion =Cotizacion::find($cotizacion_id);
         $materia_prima=Materia_prima::find($request->materia_prima_id);
         /* dd($materia_prima); */
         $cotizacion->cotizacion_detalle_id= $request->cotizacion_detalle_id;
         $cotizacion->materia_prima_id= $request->materia_prima_id;
         $cotizacion->cantidad_materia_prima= $request->cantidad_mp;
         $cotizacion->costo_materia_prima= $materia_prima->venta;
         $cotizacion->save();//Guarda la informaci'on en la tabla producto de la base de datos
        $id=$request->cotizacion_detalle_id;
        return redirect()->route('elegircotizacion', compact('id'));
    }

    public function editarMateriaPrimaSS($cotizacion_id)
    {
        $cotizacion=Cotizacion::find($cotizacion_id);
        $materia_primas=Materia_prima::all();
        return view('cotizacioncapsula.detalle_semisolido.editar', compact('cotizacion','materia_primas'));
    }
    public function actualizarMPSS(Request $request, $cotizacion_id)
    {
         $cotizacion =Cotizacion::find($cotizacion_id);
         $materia_prima=Materia_prima::find($request->materia_prima_id);
         /* dd($materia_prima); */
         $cotizacion->cotizacion_detalle_id= $request->cotizacion_detalle_id;
         $cotizacion->materia_prima_id= $request->materia_prima_id;
         $cotizacion->cantidad_materia_prima= $request->cantidad_mp;
         $cotizacion->costo_materia_prima= $materia_prima->venta;
         $cotizacion->save();//Guarda la informaci'on en la tabla producto de la base de datos
        $id=$request->cotizacion_detalle_id;
        return redirect()->route('cotizacioncapsula.detalle_semisolido.index', compact('id'));
    }
    
}
