<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receta;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Preparado;
use App\Models\Materia_prima;
use App\Models\Cotizacion;
use App\Models\CotizacionDetalle;
use Codedge\Fpdf\Fpdf\Fpdf;


class ReporteController extends Controller
{
    public function reportesMp(Request $request)
        {
            /* $paciente = Paciente::find($id); */
           /*  $fecha = $request->nombr; */
           $materia_primas=Materia_prima::where('controlado','S')->orderBy('id','desc')->get();
           $recetas=Receta::where('fecha_recepcion','%%')->orderBy('id','desc')->get();
            return view('reportesMp.index', compact('recetas','materia_primas'));
        }
        
        public function reportesMp_ver(Request $request)
        {
            /* $paciente = Paciente::find($id); */
           /*  $fecha = $request->nombr; */
           $materia_prima_id=$request->materia_prima_id;
           $from = date($request->fecha_inicial);
           $to = date($request->fecha_final);
           
           /* Reservation::whereBetween('reservation_from', [$from, $to])->get();   */ 
          
           $id_cotizaciones=Cotizacion::where('materia_prima_id', $materia_prima_id)->select('cotizacion_detalle_id')->get();
           $recetas=Receta::whereIn('numero_interno', $id_cotizaciones)
           // ->whereBetween('fecha_receta', [$from, $to])
           ->where("fecha_receta",">=",$from)
           ->where("fecha_receta","<=",$to)
           ->orderBy('id','desc')->get();
        
            return view('reportesMp.index2', compact('recetas'));
        }
        
        public function reportesLr(Request $request)
        {
            /* $paciente = Paciente::find($id); */
           /*  $fecha = $request->nombr; */
           $materia_primas=Materia_prima::where('controlado','S')->orderBy('id','desc')->get();
           
            $recetas=Receta::where('fecha_recepcion','%%')->orderBy('id','desc')->get();
            return view('reportesLr.index', compact('recetas','materia_primas'));
        }
        
        public function reportesLr_ver(Request $request)
        {
            /* $paciente = Paciente::find($id); */
           /*  $fecha = $request->nombr; */
           $materia_prima_id=$request->materia_prima_id;
           $from = date($request->fecha_inicial);
           $to = date($request->fecha_final);
           
           /* Reservation::whereBetween('reservation_from', [$from, $to])->get();   */ 
          
           $id_cotizaciones=Cotizacion::where('materia_prima_id', $materia_prima_id)->select('cotizacion_detalle_id')->get();
           $recetas=Receta::whereIn('numero_interno', $id_cotizaciones)
           // ->whereBetween('fecha_receta', [$from, $to])
           ->where("fecha_receta",">=",$from)
           ->where("fecha_receta","<=",$to)
           ->orderBy('id','desc')->get();
        
            return view('reportesLr.index2', compact('recetas'));
        }
    
        public function reportesLc(Request $request)
        {
            /* $paciente = Paciente::find($id); */
           /*  $fecha = $request->nombr; */
           $materia_primas=Materia_prima::where('controlado','S')->orderBy('id','desc')->get();
           
            $recetas=Receta::where('fecha_recepcion','%%')->orderBy('id','desc')->get();
            return view('reportesLc.index', compact('recetas','materia_primas'));
        }
        
        public function reportesLc_ver(Request $request)
        {
            /* $paciente = Paciente::find($id); */
           /*  $fecha = $request->nombr; */
           $materia_prima_id=$request->materia_prima_id;
           $from = date($request->fecha_inicial);
           $to = date($request->fecha_final);
           
           /* Reservation::whereBetween('reservation_from', [$from, $to])->get();   */ 
          
           $id_cotizaciones=Cotizacion::where('materia_prima_id', $materia_prima_id)->select('cotizacion_detalle_id')->get();
           $recetas=Receta::whereIn('numero_interno', $id_cotizaciones)
           // ->whereBetween('fecha_receta', [$from, $to])
           ->where("fecha_receta",">=",$from)
           ->where("fecha_receta","<=",$to)
           ->orderBy('id','desc')->get();
        
            return view('reportesLc.index2', compact('recetas'));
        }

        public function reportes_internos(Request $request)
        {
            /* $paciente = Paciente::find($id); */
           /*  $fecha = $request->nombr; */
           $materia_primas=Materia_prima::all();
            $recetas=Receta::where('fecha_recepcion','%%')->orderBy('id','desc')->get();
            return view('reportes_internos.index', compact('recetas','materia_primas'));
        }

        public function imprimiretiqueta(Request $request,$cotizacion_id)
    {

        $posicion = $request->posicion;
        if(($posicion%2) ==0){
            return redirect()->route('receta.etiquetaderecha',['id'=>$cotizacion_id,'i'=>$posicion]);
        }

        return redirect()->route('receta.etiquetaizquierda',['id'=>$cotizacion_id,'i'=>$posicion]);
    }
        
        public function solicitarposicion($cotizacion_id)
        {
            $receta=Receta::where('numero_interno',$cotizacion_id)->get();
            $cotizacion=CotizacionDetalle::find($cotizacion_id);

            return view('reportesMp.solicitarposicion', compact('cotizacion_id','receta','cotizacion'));

        }
        public function reportes_receta(Request $request)
        {
           $recetas=Receta::where('fecha_recepcion','%%')->orderBy('id','desc')->get();
            return view('receta_fecha.index', compact('recetas'));
        }
        public function corregir_receta(Request $request)
        {
         
           $from = date($request->fecha_inicial);
           $to = date($request->fecha_final);
           
                   $recetas=Receta::whereIn('numero_interno', $id_cotizaciones)
           // ->whereBetween('fecha_receta', [$from, $to])
           ->where("fecha_receta",">=",$from)
           ->where("fecha_receta","<=",$to)
           ->orderBy('id','desc')->get();
        
            return view('receta_fecha.index2', compact('recetas'));
        }
        

}
