<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
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
        $pacientes = Paciente::nombre($nombre)
        ->paginate(5);
    } else {
        $pacientes = Paciente::rut($nombre)
        ->paginate(5);
    }
        return view('paciente.index', compact('pacientes','nombre'));
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paciente.crear');
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
            'rut' => ['required', 'max:8'],
            'dv' => ['required', 'max:1'],
            'nombre_completo' => ['required'],
            'direccion' => ['required'],
            'telefono' => ['required'],
            'ciudad' => ['required'],
                     
        ]);

        $paciente = Paciente::where('rut',$request->rut)->get();
        if (!$paciente->isEmpty()) {
        return redirect()->route('paciente.index')->with('destroy','Paciente ya existe');    
        }
        else 
        {
            Paciente::create($request->all());
            return redirect()->route('paciente.index')->with('success','Registro creado exitosamente');
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
        $paciente = Paciente::find($id);
        return view('paciente.editar', compact('paciente'));
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
            'rut' => ['required', 'max:8'],
            'dv' => ['required', 'max:1'],
            'nombre_completo' => ['required'],
            'direccion' => ['required'],
            'telefono' => ['required'],
            'ciudad' => ['required'],
                     
        ]);


        $paciente = Paciente::find($id);
        $paciente->update($request->all());

        return redirect()->route('paciente.index')->with('success','Registro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente = Paciente::find($id);
        $paciente->delete();
        return redirect()->route('paciente.index')->with('destroy','Registro eliminado exitosamente');
    }
}

