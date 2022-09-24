<?php

namespace App\Http\Controllers;
use App\Models\Encabezado_entrada;
use App\Models\Empresa;
use App\Models\Detalle_entrada;
use App\Models\Materia_prima;

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
            'lote' => ['required'],
            'fecha_vencimiento' => ['required']
                     
        ]);

            Detalle_entrada::create($request->all());
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
            'fecha_vencimiento' => ['required']
                     
        ]);

            
            $detalle_entrada=Detalle_entrada::find($id);
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
        
        $detalle_entrada->delete();
        return redirect()->route('entrada.detalle.index',$encabezado_id)->with('destroy','Registro eliminado exitosamente');
    
    }
 
    public function elegir_detalle_entrada($id)
    {
    
        $encabezado_entrada=Encabezado_entrada::find($id);
        /* dd($cotizacion_detalle); */
        $detalle_entrada=Detalle_entrada::where('id_encabezado_entrada',$id)->get();
        /* dd($preparados); */
        return redirect()->route('entrada.detalle.index', [$id]);
    }        

}