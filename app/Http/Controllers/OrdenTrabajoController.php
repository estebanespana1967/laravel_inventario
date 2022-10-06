<?php

namespace App\Http\Controllers;

use App\Models\CotizacionDetalle;
use App\Models\Paciente;
use App\Models\Persona;
use App\Models\Receta;
use App\Models\Cotizacion;
use App\Models\Detalle_entrada;


use Illuminate\Http\Request;

class OrdenTrabajoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index(Request $request)
    {
        $nombre = $request->nombre;
        $pacientes=Paciente::where('nombre_completo', 'LIKE', '%'.$nombre.'%')->select('id')->get(); 
        $cotizaciones=CotizacionDetalle::whereIn('estado', ['TERMINADO','PRODUCCION'])
        ->whereIn('paciente_id',$pacientes)
        ->orderBy('id', 'desc')
        ->paginate(5);
      
          
    if ($request->termino_busqueda==2){
      if ($nombre=="capsula"){
        $nombre1=1;
      }  else {
        $nombre1=2;
      }
      $cotizaciones=CotizacionDetalle::whereIn('estado', ['TERMINADO','PRODUCCION'])
      ->where('tipo_cotizacion',$nombre1)
      ->orderBy('id', 'desc')
      ->paginate(5);
    
    } elseif ($request->termino_busqueda==3){
        $cotizaciones = CotizacionDetalle::where('estado', 'LIKE', '%'.$nombre.'%')
        ->orderBy('id', 'desc')
        ->paginate(5);
    
        /* dd($cotizaciones); */
    
    } elseif ($request->termino_busqueda==4){
        $cotizaciones = CotizacionDetalle::whereIn('estado', ['TERMINADO', 'PRODUCCION'])
        ->where('fecha_cotizacion',$nombre)
        ->orderBy('id', 'desc')
        ->paginate(5);
    
    }
    

    return view('ordenTrabajo.index', compact('cotizaciones','nombre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    
    public function guardarOC(Request $request, $cotizacion_id,$valor)
    {
        $cotizacion =CotizacionDetalle::find($cotizacion_id);
        $cotizacion->update($request->all());//Guarda la informaci'on en la tabla producto de la base de datos
        $id=$request->cotizacion_detalle_id;
        return redirect()->route('ordenTrabajo.guardarOrdenCompra', compact('id','valor'));
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
    public function edit(Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function updateEstado(Request $request,  $id)
    {
            $nombre = $request->nombre;
            $cotizacion = CotizacionDetalle::find($id);            
            $cotizacion->estado = "TERMINADO";
            $cotizacion->save();//Guarda la informaci'on en la tabla producto de la base de datos
            $cotizaciones=CotizacionDetalle::whereIn('estado', ['TERMINADO', 'PRODUCCION'])
            ->orderBy('id', 'desc')
            ->paginate(5);
    return view('ordenTrabajo.index', compact('cotizaciones','nombre')); 
                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotizacion $cotizacion)
    {
        //
    }
    public function ver_index_status($id)
    {
        $cotizacion_detalle=CotizacionDetalle::find($id);
        $cotizacion_existe=Receta::where('numero_interno',$id)->select('id')->get(); 
        $paciente=Paciente::find($cotizacion_detalle->paciente_id);
        $cotizaciones=Cotizacion::where('cotizacion_detalle_id',$id)->orderBy('materia_prima_id')->get();
        $cotizaciones_mp=Cotizacion::where('cotizacion_detalle_id',$id)->select('materia_prima_id')->get();
        $detalle_entrada=Detalle_entrada::whereIn('id_materia_prima',$cotizaciones_mp)
        ->where('status_mp',"EN USO")
        ->select('id_materia_prima','serie','lote','fecha_vencimiento','id')->orderBy('id_materia_prima')->get();

        if ($cotizacion_detalle->tipo_cotizacion ==1){
        return view('cotizacioncapsula.detalle_capsula.ver_index_status', compact('detalle_entrada','paciente','cotizaciones','cotizacion_detalle'));
        } else {
        return view('cotizacioncapsula.detalle_semisolido.ver_index_status', compact('detalle_entrada','paciente','cotizaciones','cotizacion_detalle'));
        }
    }
    public function updateLoteSerie(Request $request,  $id)
    {
        $cotizaciones_mp=Cotizacion::where('cotizacion_detalle_id',$id)->select('materia_prima_id')->get();
        $detalle_entrada=Detalle_entrada::whereIn('id_materia_prima',$cotizaciones_mp)
        ->where('status_mp',"EN USO")
        ->select('id_materia_prima','serie','lote','fecha_vencimiento','id')->orderBy('id_materia_prima')->get();
 
        foreach ($detalle_entrada as $detalle ) {
            
            $cotizacion=Cotizacion::where('materia_prima_id',$detalle->id_materia_prima)
            ->where('cotizacion_detalle_id',$id)
            ->get();
        
            $cotizacion[0]->id_detalle_entrada=$request->detalle_."".$detalle->id;
            // OJO !!!!   $request->detalle_."".$detalle->id_materia_prima ??

            $cotizacion[0]->save();
        }
        $nombre = "";
        
        /* $posicion_coincidencia = strpos($cadena_de_texto, $cadena_buscada);
 
            $nombre = $request->nombre;
            $cotizacion = CotizacionDetalle::find($id);            
            $cotizacion->estado = "TERMINADO";
            $cotizacion->save();//Guarda la informaci'on en la tabla producto de la base de datos
         */    $cotizaciones=CotizacionDetalle::whereIn('estado', ['TERMINADO', 'PRODUCCION'])
            ->orderBy('id', 'desc')
            ->paginate(5);
    return view('ordenTrabajo.index', compact('cotizaciones','nombre')); 
                
    }




}
