<?php

namespace App\Http\Controllers;
use App\Models\Encabezado_salida;
use App\Models\Empresa;
use App\Models\Detalle_salida;
use App\Models\Materia_prima;

use Illuminate\Http\Request;

class DetalleSalidaController extends Controller
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
        $salida = Encabezado_salida::find($id);
        $detalles_salida = Detalle_salida::where('id_encabezado_salida',$id)->get();
     /*   dd($detalles_salida[1]->id);  */
        return view('salida.detalle.index', compact('salida','detalles_salida'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create($id)
    {
        $encabezado_salida=Encabezado_salida::find($id);
        $materia_primas=Materia_prima::all();
        
        return view('salida.detalle.crear', compact('encabezado_salida','materia_primas'));
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
            'id_encabezado_salida' => ['required'],
            'id_materia_prima' => ['required'],
            'cantidad_materia_prima' => ['required'],
            'unidad_medida' => ['required'],
            'costo' => ['required'],
            'lote' => ['required'],
            'fecha_vencimiento' => ['required']
                     
        ]);

            Detalle_salida::create($request->all());
            $encabezado_id=$request->id_encabezado_salida;
            return redirect()->route('salida.detalle.index',$encabezado_id)->with('success','Registro creado exitosamente');
        

 
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
        $detalle_salida=Detalle_salida::find($id);
        $materia_primas=Materia_prima::all();
        
        return view('salida.detalle.editar', compact('detalle_salida','materia_primas'));
    
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
            'id_encabezado_salida' => ['required'],
            'id_materia_prima' => ['required'],
            'cantidad_materia_prima' => ['required'],
            'unidad_medida' => ['required'],
            'costo' => ['required'],
            'lote' => ['required'],
            'fecha_vencimiento' => ['required']
                     
        ]);

            
            $detalle_salida=Detalle_salida::find($id);
            $detalle_salida->update($request->all());
            $encabezado_id=$request->id_encabezado_salida;
            return redirect()->route('salida.detalle.index',$encabezado_id)->with('success','Registro actualizado exitosamente');
        

 
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
        
        $detalle_salida=Detalle_salida::find($id);
        $encabezado_id=$detalle_salida->id_encabezado_salida;
        
        $detalle_salida->delete();
        return redirect()->route('salida.detalle.index',$encabezado_id)->with('destroy','Registro eliminado exitosamente');
    
    }
 
    public function elegir_detalle_salida($id)
    {
    
        $encabezado_salida=Encabezado_salida::find($id);
        /* dd($cotizacion_detalle); */
        $detalle_salida=Detalle_salida::where('id_encabezado_salida',$id)->get();
        /* dd($preparados); */
        return redirect()->route('salida.detalle.index', [$id]);
    }        

}