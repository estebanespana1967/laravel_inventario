<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encabezado_salida;
use App\Models\Empresa;


class SalidaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');     
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salidas = Encabezado_salida::paginate(3);
        return view('salida.encabezado.index', compact('salidas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    $empresas = Empresa::all();
    return view('salida.encabezado.crear', compact('empresas'));
  
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
            'tipo_documento' => ['required'],
            'numero_documento' => ['required'],
            'id_empresa' => ['required'],
            'fecha_emision' => ['required'],
            'fecha_vencimiento' => ['required'],
            
            ]);
        
            $salida = Encabezado_salida::where('numero_documento',$request->numero_documento)
            ->where('id_empresa',$request->id_empresa)->get();
            if (!$salida->isEmpty()) {
            return redirect()->route('salida.encabezado.index')->with('destroy','Documento ya existe');    
            }
            else 
            {
            Encabezado_salida::create($request->all());
            return redirect()->route('salida.encabezado.index')->with('success','Registro creado exitosamente');
            }
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
        $salida = Encabezado_salida::find($id);
        $empresas = Empresa::all();
        return view('salida.encabezado.editar', compact('salida','empresas'));

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
        //
        $salida = Encabezado_salida::find($id);
        $salida->update($request->all());

        return redirect()->route('salida.encabezado.index')->with('success','Registro actualizado exitosamente');

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
        $salida = Encabezado_salida::find($id);
        $salida->delete();
        return redirect()->route('salida.encabezado.index')->with('destroy','Registro eliminado exitosamente');

    }
}
