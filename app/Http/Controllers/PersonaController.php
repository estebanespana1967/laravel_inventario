<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Paciente;

use Illuminate\Http\Request;

class PersonaController extends Controller
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

 /*    $pacientes = Paciente::orderBy('nombre_completo', 'asc')->paginate(5);
     return view('persona.index', compact('pacientes'));   */
    
   $nombre = $request->nombre;
        if ($request->termino_busqueda==1){
        $pacientes = Paciente::nombre($nombre)
        ->paginate(5);
        
    } else {
        $pacientes = Paciente::rut($nombre)
        ->paginate(5);
    }
    
        return view('persona.index', compact('pacientes','nombre'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('persona.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Paciente::create($request->all());
        return redirect()->route('persona.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $persona = Persona::find($id);
        return view('persona.editar', compact('persona'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $persona = Persona::find($id);
        $persona->update($request->all());

        return redirect()->route('persona.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $persona = Persona::find($id);
        $persona->delete();
        return redirect()->route('persona.index');
    }
    
    /* esto es nuevo */
    public function showCotizaciones($id)
    {
        $persona = Persona::find($id);
        $cotizaciones=Cotizacion::where('cotizacion_id',$id)->get();
        /* dd($recetas); */
        return view('cotizacioncapsula.showCotizaciones', compact('persona','cotizaciones'));
    }


}
