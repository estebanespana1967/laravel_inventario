<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medico;

class MedicoController extends Controller
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
        $medicos = Medico::nombre($nombre)
        ->paginate(5);
    } else {
        $medicos = Medico::rut($nombre)
        ->paginate(5);
    }
        return view('medico.index', compact('medicos','nombre'));
     
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medico.crear');
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
    'rut_medico' => ['required', 'max:8'],
    'dv_medico' => ['required', 'max:1'],
    'nombre_medico' => ['required'],
    'direccion_medico' => ['required'],
    'telefono_medico' => ['required'],
    'email_medico' => ['required'],
    'especialidad' => ['required'],
    ]);

    $medico = Medico::where('rut_medico',$request->rut_medico)->get();
    if (!$medico->isEmpty()) {
    return redirect()->route('medico.index')->with('destroy','Medico ya existe');    
    }
    else 
    {
    Medico::create($request->all());
    return redirect()->route('medico.index')->with('success','Registro creado exitosamente');
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
        $medico = Medico::find($id);
        return view('medico.editar', compact('medico'));
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
        $medico = Medico::find($id);
        $medico->update($request->all());

        return redirect()->route('medico.index')->with('success','Registro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medico = Medico::find($id);
        $medico->delete();
        return redirect()->route('medico.index')->with('destroy','Registro eliminado exitosamente');
    }
}

