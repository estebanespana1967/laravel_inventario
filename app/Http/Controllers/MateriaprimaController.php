<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia_prima;

class MateriaprimaController extends Controller


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
        $materia_primas = Materia_prima::nombre_mp($nombre)
        ->paginate(5);
    } else {
        $materia_primas = Materia_prima::fecha_venci($nombre)
        ->paginate(5);
    }
        return view('materia_prima.index', compact('materia_primas','nombre'));
     
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('materia_prima.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        Materia_prima::create($request->all());
        return redirect()->route('materia_prima.index')->with('success','Registro creado exitosamente');
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
        $materia_prima = Materia_prima::find($id);
        return view('materia_prima.editar', compact('materia_prima'));
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
        $materia_prima = Materia_prima::find($id);
        $materia_prima->update($request->all());

        return redirect()->route('materia_prima.index')->with('success','Registro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materia_prima = Materia_prima::find($id);
        $materia_prima->delete();
        return redirect()->route('materia_prima.index')->with('destroy','Registro eliminado exitosamente');
    }
}

