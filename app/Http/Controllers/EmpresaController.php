<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empresa;

class EmpresaController extends Controller

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
        $nombre_empresa = $request->nombre_empresa;
        if ($request->termino_busqueda==1){
    
    // funcion scope creado en el modelo Empresa en este caso "nombre" y "rut"
            $empresas = Empresa::nombre($nombre_empresa)->paginate(5);          
    } else {
        $empresas = Empresa::rut($nombre_empresa)->paginate(5);        
    }
        return view('empresas.index', compact('empresas','nombre_empresa'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('empresas.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $request->validate([
    'rut_empresa' => ['required', 'max:8'],
    'dv_empresa' => ['required', 'max:1'],
    'nombre_empresa' => ['required'],
    'direccion_empresa' => ['required'],
    'telefono_empresa' => ['required'],
    'email_empresa' => ['required'],
    'contacto' => ['required'],
    ]);

    $empresa = Empresa::where('rut_empresa',$request->rut_empresa)->get();
    if (!$empresa->isEmpty()) {
    return redirect()->route('empresas.index')->with('destroy','Empresa ya existe');    
    }
    else 
    {
    Empresa::create($request->all());
    return redirect()->route('empresas.index')->with('success','Registro creado exitosamente');
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
        $empresa = Empresa::find($id);
        return view('empresas.editar', compact('empresa'));
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
        $empresa = Empresa::find($id);
        $empresa->update($request->all());

        return redirect()->route('empresas.index')->with('success','Registro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empresa = Empresa::find($id);
        $empresa->delete();
        return redirect()->route('empresas.index')->with('destroy','Registro eliminado exitosamente');
    }
}
