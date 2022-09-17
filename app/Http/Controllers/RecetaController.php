<?php

namespace App\Http\Controllers;

use App\Models\Receta;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Preparado;
use App\Models\Materia_prima;
use App\Models\Cotizacion;
use App\Models\CotizacionDetalle;
use Codedge\Fpdf\Fpdf\Fpdf;



use PDF;

use Illuminate\Http\Request;

class RecetaController extends Controller
{
    protected $fpdf;

    public function __construct(){
        $this->middleware('auth'); 
        $this->fpdf = new Fpdf;    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacientes = Paciente::paginate(5);
        return view('receta.index', compact('pacientes'));
   
    }


    public function showHistorial($id)
        {
            $paciente = Paciente::find($id);
            $recetas=Receta::where('paciente_id',$id)->orderBy('id','desc')->get();
            return view('receta.showHistorial', compact('paciente','recetas'));
        }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create(Request $request, $id)
        {
        $paciente=Paciente::find($id);
        $medicos=Medico::all();
        
    return view('receta.crear', compact('paciente','medicos'));
    }

    public function createBlanca($id)
    {
        $paciente=Paciente::find($id);
        $medicos=Medico::all();
        return view('receta.createBlanca', compact('paciente','medicos'));
    }

    public function createcot(Request $request, $id, $cot_id)
    {
    $paciente=Paciente::find($id);
    $medicos=Medico::all();
    
return view('receta.crear', compact('paciente','medicos','cot_id'));
}

public function createBlancacot($id, $cot_id)
{
    $paciente=Paciente::find($id);
    $medicos=Medico::all();
    return view('receta.createBlanca', compact('paciente','medicos','cot_id'));
}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $receta=Receta::create($request->all());
        $id=$receta->numero_interno;

        $fecha1=$receta->fecha_recepcion;
        $fecha2=$receta->fecha_receta;
        $diferencia = abs((strtotime($fecha1) - strtotime($fecha2))/86400); 
        echo $fecha1,$fecha2,$diferencia;

        return redirect()->route('elegircotizacion', compact('id'))->with('success','diferencia.$diferencia');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
        $receta=Receta::find($id);
        $pacientes=Paciente::all();
        $medicos=Medico::all();
        if ($receta->tipo_receta=="cheque") {
            return view('receta.editar', compact('receta','pacientes','medicos'));
        } else {
            return view('receta.editarblanca', compact('receta','pacientes','medicos'));
        }
        
    }
    public function indexpreparadocapsula($id)

    {
        $receta=Receta::find($id);
        $paciente=Paciente::find($receta->paciente_id);
        $medico=Medico::find($receta->doctor_id);
        /* $materia_prima=Materia_prima::find($receta->id); */
        $materia_prima=Materia_prima::all();
        $preparados=Preparado::where('receta_id',$receta->id)->get();
        /* dd($preparados); */
        return view('receta.preparadocapsula.index', compact('receta','paciente','medico','preparados','materia_prima'));
    }

    public function createMateriaPrima($receta_id)
    {
        $receta=Receta::find($receta_id);
        $materia_primas=Materia_prima::all();
        return view('receta.preparadocapsula.crear', compact('receta','materia_primas'));
    }


    public function storeMateriaPrima(Request $request)
    {
         $preparado = new Preparado();
         $materia_prima=Materia_prima::find($request->materia_prima_id);
         /* dd($materia_prima); */
         $preparado->receta_id= $request->receta_id;
         $preparado->materia_prima_id= $request->materia_prima_id;
         $preparado->cantidad_materia_prima= $request->cantidad_mp;
         $preparado->costo_materia_prima= $materia_prima->venta;

        $preparado->save();//Guarda la informaci'on en la tabla producto de la base de datos
        $id=$request->receta_id;
        return redirect()->route('receta.preparadocapsula.index', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $receta = Receta::find($id);
        $receta->update($request->all());
        $id=$receta->paciente_id;
        return $this->showHistorial($id);
        /* return redirect()->route('receta.historial', compact('id')); */
    } 
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $receta = Receta::find($id);
        $receta->delete();
        return redirect()->route('receta.historial',$receta->paciente_id);


    }
    public function destroyMateriaPrima($preparado_id,$receta_id)
    {
     /*    dd($preparado_id); */
        
        $preparado = Preparado::find($preparado_id);
        $preparado->delete();
        $id=$receta_id;
        return redirect()->route('receta.preparadocapsula.index', compact('id'));
    }
    
    public function editMateriaPrima($preparado_id)
    {
        $preparado=Preparado::find($preparado_id);
        $receta=Receta::find($preparado->receta_id);
        $materia_primas=Materia_prima::all();
        return view('receta.preparadocapsula.editar', compact('receta','materia_primas','preparado'));
    }


    public function updateMateriaPrima(Request $request, $preparado_id)
    {
         $preparado =Preparado::find($preparado_id);
         $materia_prima=Materia_prima::find($request->materia_prima_id);
         /* dd($materia_prima); */
         $preparado->receta_id= $request->receta_id;
         $preparado->materia_prima_id= $request->materia_prima_id;
         $preparado->cantidad_materia_prima= $request->cantidad_mp;
         $preparado->costo_materia_prima= $materia_prima->venta;

        $preparado->save();//Guarda la informaci'on en la tabla producto de la base de datos
        $id=$request->receta_id;
        return redirect()->route('receta.preparadocapsula.index', compact('id'));
    }
    public function etiquetaizquierda($cotizacion_id, $i)

        {
            
            $receta=Receta::where('numero_interno',$cotizacion_id)->get();
           /*  dd($receta); */
            $cotizacion=CotizacionDetalle::find($cotizacion_id);
        $fecha_elaboracion= date("d/m/Y", strtotime($cotizacion->fecha_elaboracion));
        $fecha_vencimiento= date("d/m/Y", strtotime($cotizacion->fecha_vencimiento));

        $this->fpdf->SetFont('Arial', 'B', 6);
        $this->fpdf->AddPage("P", ['210', '297']);
        $arreY=[0,10,10,52,52,94,94,136,136,178,178,220,220,262,262];
        
        $this->fpdf->SetY($arreY[$i]);
        
        if($cotizacion->tipo_cotizacion==1){
            $v_medico=utf8_decode($receta[0]->medico->nombre_medico);
            $this->fpdf->Cell(40,4,'Dr: '.$v_medico,0,0,'');
            $this->fpdf->Cell(40,4,'FF:Capsula'.'  RM'.$receta[0]->numero_interno.'/2022',0,1,'');
        } else  { 
            $v_medico=utf8_decode($receta[0]->medico->nombre_medico);  
            $this->fpdf->Cell(40,4,'Dr: '.$v_medico,0,0,'');    
            $this->fpdf->Cell(40,4,'FF:'.$cotizacion->base_crema[0]->nombre_base_crema,0,1,'');     
        } 
        
        if($cotizacion->tipo_cotizacion==1){
        $materiap="";
        $a=0;
        foreach ($cotizacion->materia_primas as $coti){
        $materiap=$materiap." ".$coti->nombre_mp; 
         
        if ($coti->pivot->cantidad_materia_prima > 1){
        $a=$a+1;
        }
        $this->fpdf->SetFont('Arial', 'B', 5);
        if ($a%2==0){
            
            $materiap=$materiap." ".$coti->pivot->cantidad_materia_prima." MG \n";
        }else{
            
            $materiap=$materiap." ".$coti->pivot->cantidad_materia_prima." MG ";
        }


        }
     /*    $this->fpdf->MultiCell(50,4,'Pac.: '.$receta[0]->paciente->nombre_completo.'\n',0,0,''); */
     $this->fpdf->SetFont('Arial', 'B', 6);

     $v_paciente=utf8_decode($receta[0]->paciente->nombre_completo);  
        $this->fpdf->Cell(40,4,'Pac: '.$v_paciente,0,0,'');            
        $this->fpdf->MultiCell(50,3,$materiap,0,1,'');   
        
        } else {
                
        $materiap="";
        
        foreach ($cotizacion->materia_primas as $coti){
        $materiap=$materiap." ".$coti->nombre_mp; 
        $materiap=$materiap." ".$coti->pivot->cantidad_materia_prima." %, "; 
        }
        $v_paciente=utf8_decode($receta[0]->paciente->nombre_completo); 
        $this->fpdf->Cell(40,4,'Pac.: '.$v_paciente,0,0,'');
        $this->fpdf->MultiCell(40,4,$materiap,0,1,'');
        }
        
                                
        if($cotizacion->tipo_cotizacion==1)
        {
        $this->fpdf->Cell(40,4,'Fecha Elab '.$fecha_elaboracion,0,0,'');
        $this->fpdf->Cell(40,4,'CSP '.$cotizacion->cantidad_capsulas.' CAPS',0,1,''); 
        
        } else {
        $this->fpdf->Cell(40,4,'Fecha Elab '.$fecha_elaboracion,0,0,'');
        $this->fpdf->Cell(40,4,'CSP '.$cotizacion->cantidad_capsulas.' GRS',0,1,'');
            
    }
    $this->fpdf->Cell(40,4,'Fecha Venci '.$fecha_vencimiento,0,0,'');   
    $this->fpdf->Cell(40,4,'DOSIS '.$receta[0]->posologia_diaria.' AL DIA',0,1,'');                
       $mensaje=utf8_decode("Mantener Fuera del alcance de los niños y conservar en lugar fresco y seco. Resolucion RF XIII 05/20 1A,1B, y 2C Farmavida. Nota: Eliminar este producto despues fecha vencimiento., Recoleta 5418, Huechuraba");
       $this->fpdf->MultiCell(80,2,$mensaje,0,0,''); 
              
       $this->fpdf->Output('ticket.pdf','i');
       exit;
      
    /*     return view('receta.etiqueta.index', compact('cotizacion','receta'));
     */    
    
    }
    
    public function etiquetaderecha($cotizacion_id,$i)

    {
        
        $receta=Receta::where('numero_interno',$cotizacion_id)->get();
       /*  dd($receta); */
        $cotizacion=CotizacionDetalle::find($cotizacion_id);
    $fecha_elaboracion= date("d/m/Y", strtotime($cotizacion->fecha_elaboracion));
    $fecha_vencimiento= date("d/m/Y", strtotime($cotizacion->fecha_vencimiento));

    $this->fpdf->SetFont('Arial', 'B', 6);
    $this->fpdf->AddPage("P", ['210', '297']);
    $arreY=[0,10,10,52,52,94,94,136,136,178,178,220,220,262,262];
    
    $this->fpdf->SetY($arreY[$i]);
    
    if($cotizacion->tipo_cotizacion==1){
        $v_medico=utf8_decode($receta[0]->medico->nombre_medico);
        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(40,4,'Dr: '.$v_medico,0,0,'');
        $this->fpdf->Cell(40,4,'FF:Capsula'.'  RM'.$receta[0]->numero_interno.'/2022',0,1,'');
    } else  { 
        $v_medico=utf8_decode($receta[0]->medico->nombre_medico);  
        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(40,4,'Dr: '.$v_medico,0,0,'');    
        $this->fpdf->Cell(40,4,'FF:'.$cotizacion->base_crema[0]->nombre_base_crema,0,1,'');     
    } 
    
    if($cotizacion->tipo_cotizacion==1){
    $materiap="";
    $a=0;
    foreach ($cotizacion->materia_primas as $coti){
    $materiap=$materiap." ".$coti->nombre_mp; 
     
    if ($coti->pivot->cantidad_materia_prima > 1){
    $a=$a+1;
    }
    $this->fpdf->SetFont('Arial', 'B', 5);
    if ($a%2==0){
        
        $materiap=$materiap." ".$coti->pivot->cantidad_materia_prima." MG \n";
    }else{
        
        $materiap=$materiap." ".$coti->pivot->cantidad_materia_prima." MG ";
    }


    }
 /*    $this->fpdf->MultiCell(50,4,'Pac.: '.$receta[0]->paciente->nombre_completo.'\n',0,0,''); */
 $this->fpdf->SetFont('Arial', 'B', 6);

 $v_paciente=utf8_decode($receta[0]->paciente->nombre_completo);  
 $this->fpdf->Cell(100,4,'',0,0,'C');
 $this->fpdf->Cell(40,4,'Pac: '.$v_paciente,0,0,'');            
 
 $this->fpdf->MultiCell(50,3,$materiap,0,1,'');   
    
    } else {
            
    $materiap="";
    
    foreach ($cotizacion->materia_primas as $coti){
    $materiap=$materiap." ".$coti->nombre_mp; 
    $materiap=$materiap." ".$coti->pivot->cantidad_materia_prima." %, "; 
    }
    $v_paciente=utf8_decode($receta[0]->paciente->nombre_completo); 
    $this->fpdf->Cell(100,4,'',0,0,'C');
    $this->fpdf->Cell(40,4,'Pac.: '.$v_paciente,0,0,'');
    $this->fpdf->MultiCell(40,4,$materiap,0,1,'');
    }
    
                            
    if($cotizacion->tipo_cotizacion==1)
    {
        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(40,4,'Fecha Elab '.$fecha_elaboracion,0,0,'');
        $this->fpdf->Cell(40,4,'CSP '.$cotizacion->cantidad_capsulas.' CAPS',0,1,''); 
    
    } else {
        $this->fpdf->Cell(100,4,'',0,0,'C');
        $this->fpdf->Cell(40,4,'Fecha Elab '.$fecha_elaboracion,0,0,'');
        $this->fpdf->Cell(40,4,'CSP '.$cotizacion->cantidad_capsulas.' GRS',0,1,'');
        
}
$this->fpdf->Cell(100,4,'',0,0,'C');
$this->fpdf->Cell(40,4,'Fecha Venci '.$fecha_vencimiento,0,0,'');   
$this->fpdf->Cell(40,4,'DOSIS '.$receta[0]->posologia_diaria.' AL DIA',0,1,'');                
   $mensaje=utf8_decode("Mantener Fuera del alcance de los niños y conservar en lugar fresco y seco. Resolucion RF XIII 05/20 1A,1B, y 2C Farmavida. Nota: Eliminar este producto despues fecha vencimiento., Recoleta 5418, Huechuraba");
   $this->fpdf->Cell(100,4,'',0,0,'C');
   $this->fpdf->MultiCell(80,2,$mensaje,0,0,''); 
   $this->fpdf->Cell(100,4,'',0,0,'C');
   $this->fpdf->Output('ticket.pdf','i');
   exit;
  
/*     return view('receta.etiqueta.index', compact('cotizacion','receta'));
 */    

}



    public function generatepdf($cotizacion_id)
    {
    $receta=Receta::where('numero_interno',$cotizacion_id)->get();
    $cotizacion=CotizacionDetalle::find($cotizacion_id);
    $pdf = PDF::loadView('receta.etiqueta.etiquetaprueba', ['cotizacion'=>$cotizacion,'receta'=> $receta]);
    return $pdf->download('latihanpdf.pdf');
}
}
