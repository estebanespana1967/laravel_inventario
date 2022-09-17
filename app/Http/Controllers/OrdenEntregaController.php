<?php

namespace App\Http\Controllers;

use App\Models\CotizacionDetalle;
use Illuminate\Http\Request;

class OrdenEntregaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');     
    }    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cotizaciones=CotizacionDetalle::whereIn('estado', ['TERMINADO','ENTREGADO'])
        ->orderBy('id', 'desc')
        ->paginate(5);
       /*  dd($cotizaciones); */
       /*  $persona=Persona::find($cotizaciones->persona_id); */
        /* dd($persona); */
return view('ordenEntrega.index', compact('cotizaciones')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function show(Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Cotizacion $cotizacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cotizacion $cotizacion)
    {
        //
    }
    public function updateEstado(Request $request,  $id)
    {
            $cotizacion = CotizacionDetalle::find($id);            
            $cotizacion->estado = 'ENTREGADO';
            $cotizacion->save();//Guarda la informaci'on en la tabla producto de la base de datos
            $cotizaciones=CotizacionDetalle::whereIn('estado', ['TERMINADO','ENTREGADO'])
        ->orderBy('id', 'desc')
        ->get();
           
    return view('ordenEntrega.index', compact('cotizaciones')); 
                
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cotizacion  $cotizacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cotizacion $cotizacion)
    {
        //
    }
}
