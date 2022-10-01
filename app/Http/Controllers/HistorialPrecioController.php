<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Historial_precio;


class HistorialPrecioController extends Controller
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
        $historiales = Historial_precio::Materiaprima($nombre)
         ->paginate(5);
        } else {
        $historiales = Historial_precio::FechaPrecio($nombre)
        ->paginate(5);
        } 
    return view('historial_precio.index', compact('historiales','nombre'));
       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('historial_precio.crear');
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
    'id_materia_prima' => ['required'],
    'precio_compra' => ['required', 'max:1'],
    'precio_venta' => ['required'],
    'fecha_precio' => ['required'],
    'id_detalle_entrada' => ['required'],
    
    ]);

    $historial_precio = Historial_precio::where('id_materia_prima',$request->id_materia_prima)->get();
    if (!historial_precio->isEmpty()) {
    return redirect()->route('historial_precio.index')->with('destroy','historial precio ya existe');    
    }
    else 
    {
    Historial_precio::create($request->all());
    return redirect()->route('historial_precio.index')->with('success','Registro creado exitosamente');
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
        $historial_precio = Historial_precio::find($id);
        return view('historial_precio.editar', compact('historial_precio'));
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
        $historial_precio = Historial_precio::find($id);
        $historial_precio->update($request->all());
        return redirect()->route('historial_precio.index')->with('success','Registro actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $historial_precio = Historial_precio::find($id);
        $historial_precio->delete();
        return redirect()->route('historial_precio.index')->with('destroy','Registro eliminado exitosamente');
    }
}

