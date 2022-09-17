<?php

namespace App\Http\Controllers;

use App\Models\CotizacionDetalle;
use App\Models\Paciente;
use App\Models\Persona;
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
}
