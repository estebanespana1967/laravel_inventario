<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encabezado_entrada;
use App\Models\Empresa;
use App\Models\Responsable;


class EntradaController extends Controller
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
        $entradas = Encabezado_entrada::paginate(3);
        return view('entrada.encabezado.index', compact('entradas'));
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
    $responsables = Responsable::all();
    
    return view('entrada.encabezado.crear', compact('empresas','responsables'));
  
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
        
            $entrada = Encabezado_entrada::where('numero_documento',$request->numero_documento)
            ->where('id_empresa',$request->id_empresa)->get();
            if (!$entrada->isEmpty()) {
            return redirect()->route('entrada.encabezado.index')->with('destroy','Documento ya existe');    
            }
            else 
            {
            Encabezado_entrada::create($request->all());
            return redirect()->route('entrada.encabezado.index')->with('success','Registro creado exitosamente');
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
        $entrada = Encabezado_entrada::find($id);
        $empresas = Empresa::all();
        $responsables = Responsable::all();

        return view('entrada.encabezado.editar', compact('entrada','empresas','responsables'));

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
        $entrada = Encabezado_entrada::find($id);
        $entrada->update($request->all());

        return redirect()->route('entrada.encabezado.index')->with('success','Registro actualizado exitosamente');

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
        $entrada = Encabezado_entrada::find($id);
        $entrada->delete();
        return redirect()->route('entrada.encabezado.index')->with('destroy','Registro eliminado exitosamente');

    }
}
