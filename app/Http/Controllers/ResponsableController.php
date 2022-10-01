<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responsable;

class ResponsableController extends Controller
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
        if ($request->termino_busqueda==1){
        $responsables = Responsable::nombre($nombre)
        ->paginate(5);
    } else {
        $responsables = Responsable::rut($nombre)
        ->paginate(5);
    }
        return view('responsable.index', compact('responsables','nombre'));
     
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('responsable.crear');
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
    'rut_responsable' => ['required', 'max:8'],
    'dv_responsable' => ['required', 'max:1'],
    'nombre_apellido' => ['required'],
    'cargo' => ['required'],
    
    ]);

    $responsable = Responsable::where('rut_responsable',$request->rut_responsable)->get();
    if (!$responsable->isEmpty()) {
    return redirect()->route('responsable.index')->with('destroy','Responsable ya existe');    
    }
    else 
    {
    Responsable::create($request->all());
    return redirect()->route('responsable.index')->with('success','Registro creado exitosamente');
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
        $responsable = Responsable::find($id);
        return view('responsable.editar', compact('responsable'));
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
        $responsable = Responsable::find($id);
        
        $responsable->rut_responsable =$request->rut_responsable;
        $responsable->dv_responsable =$request->dv_responsable;
        $responsable->nombre_apellido =$request->nombre_apellido;
        $responsable->cargo =$request->cargo;
        
        $responsable->update();

        return redirect()->route('responsable.index')->with('success','Registro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $responsable = Responsable::find($id);
        $responsable->delete();
        return redirect()->route('responsable.index')->with('destroy','Registro eliminado exitosamente');
    }
}

