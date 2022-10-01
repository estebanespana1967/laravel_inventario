<?php

namespace App\Http\Controllers;
use App\Models\Encabezado_entrada;
use App\Models\Empresa;
use App\Models\Detalle_entrada;
use App\Models\Materia_prima;
use App\Models\Historial_precio;
use Carbon\Carbon;


use Illuminate\Http\Request;

class DetalleEntradaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');     
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $entrada = Encabezado_entrada::find($id);
        $detalles_entrada = Detalle_entrada::where('id_encabezado_entrada',$id)->get();
     /*   dd($detalles_entrada[1]->id);  */
        return view('entrada.detalle.index', compact('entrada','detalles_entrada'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create($id)
    {
        $encabezado_entrada=Encabezado_entrada::find($id);
        $materia_primas=Materia_prima::all();
        
        return view('entrada.detalle.crear', compact('encabezado_entrada','materia_primas'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id_encabezado_entrada' => ['required'],
            'id_materia_prima' => ['required'],
            'cantidad_materia_prima' => ['required'],
            'unidad_medida' => ['required'],
            'costo' => ['required'],
            'venta' => ['required'],
            'lote' => ['required'],
            'serie' => ['required'],
           'fecha_vencimiento' => ['required']
                     
        ]);
            $detalle_entrada=new Detalle_entrada();
            $detalle_entrada->id_encabezado_entrada=$request->id_encabezado_entrada;
            $detalle_entrada->id_materia_prima=$request->id_materia_prima;
            $detalle_entrada->cantidad_materia_prima=$request->cantidad_materia_prima;
            $detalle_entrada->unidad_medida=$request->unidad_medida;
            $detalle_entrada->costo=$request->costo;
            $detalle_entrada->lote=$request->lote;
            $detalle_entrada->serie=$request->serie;
            
            $detalle_entrada->fecha_vencimiento=$request->fecha_vencimiento;
            $detalle_entrada->status_mp='SELLADO';
            $detalle_entrada->stock_mp=$request->cantidad_materia_prima;
            
            $detalle_entrada->save();

            
             $materia_prima=Materia_prima::find($request->id_materia_prima);
             $stock_nuevo=$materia_prima->stock+$request->cantidad_materia_prima;
             $materia_prima->stock=$stock_nuevo;
             $materia_prima->update();
             
            // aqui va la actualizacion de la columna stock que esta en la tabla materia prima
            //luego hay que insertar un registro en le tabla movimiento
            // algo parecido tenemos que hacee en update

            if ($request->venta != $request->ultimo_precio){
            $historial_precio= new Historial_precio();
            $historial_precio->id_materia_prima=$request->id_materia_prima;
            $historial_precio->precio_compra=$request->costo;
            $historial_precio->fecha_precio="2022-09-25";
            $historial_precio->precio_venta=$request->venta;
            $historial_precio->id_detalle_entrada=$detalle_entrada->id;
            
            $historial_precio->save();
        }
            $encabezado_id=$request->id_encabezado_entrada;
            return redirect()->route('entrada.detalle.index',$encabezado_id)->with('success','Registro creado exitosamente');
        

 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $detalle_entrada=Detalle_entrada::find($id);
        $materia_primas=Materia_prima::all();
        
        return view('entrada.detalle.editar', compact('detalle_entrada','materia_primas'));
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
           $request->validate([
            'id_encabezado_entrada' => ['required'],
            'id_materia_prima' => ['required'],
            'cantidad_materia_prima' => ['required'],
            'unidad_medida' => ['required'],
            'costo' => ['required'],
            'lote' => ['required'],
            'serie' => ['required'],
             'fecha_vencimiento' => ['required']
                     
        ]);

            
            $detalle_entrada=Detalle_entrada::find($id);
            $detalle_entrada->id_encabezado_entrada=$request->id_encabezado_entrada;
            $detalle_entrada->id_materia_prima=$request->id_materia_prima;
            $detalle_entrada->cantidad_materia_prima=$request->cantidad_materia_prima;
            $detalle_entrada->unidad_medida=$request->unidad_medida;
            $detalle_entrada->costo=$request->costo;
            $detalle_entrada->lote=$request->lote;
            $detalle_entrada->serie=$request->serie;
            
            $detalle_entrada->fecha_vencimiento=$request->fecha_vencimiento;
            $detalle_entrada->status_mp=$detalle_entrada->status_mp;
            if ($detalle_entrada->status_mp=='SELLADO') {
           
                $detalle_entrada->stock_mp=$request->cantidad_materia_prima;
            } else {
            
                $detalle_entrada->stock_mp=$detalle_entrada->stock_mp;
            
            }
            
            $detalle_entrada->stock_mp=$detalle_entrada->stock_mp;
            
            $detalle_entrada->update();

            if ($request->venta != $request->ultimo_precio){
            $historial_precio= Historial_precio::where('id_detalle_entrada', $detalle_entrada->id)->get();
            $historial_precio->id_materia_prima=$request->id_materia_prima;
            $historial_precio->precio_compra=$request->costo;
            $historial_precio->fecha_precio=$request->fecha_precio;
            $historial_precio->precio_venta=$request->venta;
            $historial_precio->update();
        }
    
            $detalle_entrada->update($request->all());
            $encabezado_id=$request->id_encabezado_entrada;
            return redirect()->route('entrada.detalle.index',$encabezado_id)->with('success','Registro actualizado exitosamente');
        

 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        
        $detalle_entrada=Detalle_entrada::find($id);
        $encabezado_id=$detalle_entrada->id_encabezado_entrada;
        $historial_precio= Historial_precio::where('id_detalle_entrada', $detalle_entrada->id)->get();
        
        $detalle_entrada->delete();
        $historial_precio->delete();
        return redirect()->route('entrada.detalle.index',$encabezado_id)->with('destroy','Registro eliminado exitosamente');
    
    }
 
    public function elegir_detalle_entrada($id)
    {
    
        $encabezado_entrada=Encabezado_entrada::find($id);
        /* dd($cotizacion_detalle); */
        $detalle_entrada=Detalle_entrada::where('id_encabezado_entrada',$id)->get();
        /* dd($preparados); */$mp_entradas=Detalle_entrada::paginate(3);
 
        return redirect()->route('entrada.detalle.index', [$id]);
    }        

    
    public function mp_status_index(Request $request)
    {
               
        $nombre = $request->nombre;
        if ($request->termino_busqueda==0){
        $mp_entradas=Detalle_entrada::orderBy('fecha_vencimiento', 'asc')
        ->paginate(5);
        
        } elseif ($request->termino_busqueda==1){
        
          
        $id_materia_prima=Materia_prima::where('nombre_mp', 'LIKE', '%'.$nombre.'%')
        ->select('id')->get();
        $mp_entradas=Detalle_entrada::whereIn('id_materia_prima',$id_materia_prima)
        ->orderBy('fecha_vencimiento', 'asc')
        ->paginate(5);
      
    
    } elseif ($request->termino_busqueda==2){
        $currentDateTime = Carbon::parse($nombre);
        $fecha_final = ($currentDateTime->addDays(90))->format('Y-m-d');
        $fecha_inicial = ($currentDateTime->subDays(90))->format('Y-m-d');
        dd($fecha_inicial);

        $mp_entradas=Detalle_entrada::whereBetween('fecha_vencimiento', array($fecha_inicial, $fecha_final))
        ->orderBy('fecha_vencimiento', 'asc')
        ->paginate(5);

   } else {
  
    $mp_entradas=Detalle_entrada::where('status_mp',$nombre)
    ->orderBy('fecha_vencimiento', 'asc')
    ->paginate(5);
  
    }
    return view('materia_prima_status.index', compact('mp_entradas','nombre'));
    }
}