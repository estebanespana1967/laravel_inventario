<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\MateriaprimaController;
use App\Http\Controllers\RecetaController;
use App\Http\Controllers\OrdenTrabajoController;
use App\Http\Controllers\OrdenEntregaController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\DetalleEntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\DetalleSalidaController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\HistorialPrecioController;


use App\Http\Livewire\Productos;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');


Route::get('/imprimir',[Controller::class,'imprimir'])->name('imprimir.index');

Route::get('/paciente',[PacienteController::class,'index'])->name('paciente.index');
Route::get('/paciente/crear',[PacienteController::class,'create'])->name('paciente.create');
Route::post('/paciente/guardar',[PacienteController::class,'store'])->name('paciente.store');
Route::get('/paciente/editar/{id}',[PacienteController::class,'edit'])->name('paciente.edit');
Route::put('/paciente/actualizar/{id}', [PacienteController::class, 'update'])->name('paciente.update');
Route::delete('/paciente/eliminar/{id}', [PacienteController::class, 'destroy'])->name('paciente.destroy');

Route::get('/persona',[PersonaController::class,'index'])->name('persona.index');
Route::get('/persona/crear',[PersonaController::class,'create'])->name('persona.create');
Route::post('/persona/guardar',[PersonaController::class,'store'])->name('persona.store');
Route::get('/persona/editar/{id}',[PersonaController::class,'edit'])->name('persona.edit');
Route::put('/persona/actualizar/{id}', [PersonaController::class, 'update'])->name('persona.update');
Route::delete('/persona/eliminar/{id}', [PersonaController::class, 'destroy'])->name('persona.destroy');

Route::get('/cotizacioncapsula/{paciente_id}',[CotizacionController::class,'index'])->name('cotizacioncapsula.index');
Route::get('/cotizacioncapsula/crear/{paciente_id}',[CotizacionController::class,'create'])->name('cotizacioncapsula.create');
Route::post('/cotizacioncapsula/guardar',[CotizacionController::class,'store'])->name('cotizacioncapsula.store');
Route::get('/cotizacioncapsula/editar/{id}',[CotizacionController::class,'edit'])->name('cotizacioncapsula.edit');
Route::put('/cotizacioncapsula/actualizar/{id}', [CotizacionController::class, 'update'])->name('cotizacioncapsula.update');
Route::put('/cotizacioncapsula/actualizarestado/{id}', [CotizacionController::class, 'updateEstadoCapsula'])->name('cotizacioncapsula.updateEstadoCapsula');

Route::put('/cotizacioncapsula/actualizarestadosemisolido/{id}', [CotizacionController::class, 'updateEstadoSemisolido'])->name('cotizacioncapsula.updateEstadoSemisolido');

Route::delete('/cotizacioncapsula/eliminar/{id}', [CotizacionController::class, 'destroy'])->name('cotizacioncapsula.destroy');
Route::get('/cotizacioncapsula/historial/{persona_id}', [CotizacionController::class, 'showCotizaciones'])->name('cotizacioncapsula.historial');
Route::get('/cotizacioncapsula/indexcotizacioncapsula/{id}',[CotizacionController::class,'indexcotizacioncapsula'])->name('cotizacioncapsula.detalle_capsula.index');

Route::get('/cotizacioncapsula/elegircotizacion/{id}',[CotizacionController::class,'elegircotizacion'])->name('elegircotizacion');
Route::get('/cotizacioncapsula/ver_index/{id}',[CotizacionController::class,'ver_index'])->name('ver_index');
Route::get('/cotizacionmateriaprima/ver_index_status/{id}',[OrdenTrabajoController::class,'ver_index_status'])->name('ver_index_status');


Route::get('/cotizacioncapsula/crearcotizacioncapsula/{cotizacion_id}',[CotizacionController::class,'crearMateriaPrima'])->name('cotizacioncapsula.crearMateriaPrima');
Route::post('/cotizacioncapsula/guardarcotizacioncapsula',[CotizacionController::class,'guardarMateriaPrima'])->name('cotizacioncapsula.guardarMateriaPrima');
Route::get('/cotizacioncapsula/editarcotizacioncapsula/{cotizacion_id}',[CotizacionController::class,'editarMateriaPrima'])->name('cotizacioncapsula.editarMateriaPrima');
Route::put('/cotizacioncapsula/actualizarcotizacioncapsula/{cotizacion_id}/',[CotizacionController::class,'actualizarMP'])->name('cotizacioncapsula.actualizarMP');
Route::delete('/cotizacioncapsula/indexcotizacioncapsula/{cotizacion_id}', [CotizacionController::class, 'eliminarMateriaPrima'])->name('cotizacioncapsula.detalle_capsula.eliminarMateriaPrima');

Route::delete('/cotizacioncapsula/indexcotizacionsemisolido/{cotizacion_id}', [CotizacionController::class, 'eliminarMateriaPrimaSS'])->name('cotizacioncapsula.detalle_semisolido.eliminarMateriaPrima');
Route::get('/cotizacioncapsula/indexcotizacionsemisolido/{id}',[CotizacionController::class,'indexcotizacionsemisolido'])->name('cotizacioncapsula.detalle_semisolido.index');
Route::get('/cotizacioncapsula/editarcotizacionsemisolido/{cotizacion_id}',[CotizacionController::class,'editarMateriaPrimaSS'])->name('cotizacioncapsula.editarMateriaPrimaSS');
Route::put('/cotizacioncapsula/actualizarcotizacionsemisolido/{cotizacion_id}/',[CotizacionController::class,'actualizarMPSS'])->name('cotizacioncapsula.actualizarMPSS');


Route::get('/receta',[RecetaController::class,'index'])->name('receta.index');
Route::get('/receta/crear/{paciente_id}',[RecetaController::class,'create'])->name('receta.create');
Route::get('/receta/createBlanca/{paciente_id}',[RecetaController::class,'createBlanca'])->name('receta.createBlanca');
Route::get('/receta/crearcot/{paciente_id}/{cotizacion_id}',[RecetaController::class,'createcot'])->name('receta.createcot');
Route::get('/receta/createBlancacot/{paciente_id}/{cotizacion_id}',[RecetaController::class,'createBlancacot'])->name('receta.createBlancacot');


Route::post('/receta/guardar',[RecetaController::class,'store'])->name('receta.store');
Route::get('/receta/editar/{id}',[RecetaController::class,'edit'])->name('receta.edit');
Route::put('/receta/actualizar/{id}', [RecetaController::class, 'update'])->name('receta.update');
Route::delete('/receta/eliminar/{id}', [RecetaController::class, 'destroy'])->name('receta.destroy');
Route::get('/historial/{paciente_id}', [RecetaController::class, 'showHistorial'])->name('receta.historial');
Route::get('/receta/indexpreparadocapsula/{id}',[RecetaController::class,'indexpreparadocapsula'])->name('receta.preparadocapsula.index');
Route::get('/receta/crearpreparadocapsula/{receta_id}',[RecetaController::class,'createMateriaPrima'])->name('receta.createMateriaPrima');
Route::post('/receta/guardarpreparadocapsula',[RecetaController::class,'storeMateriaPrima'])->name('receta.storeMateriaPrima');
Route::get('/receta/editarpreparadocapsula/{preparado_id}',[RecetaController::class,'editMateriaPrima'])->name('receta.editMateriaPrima');
Route::put('/receta/actualizarpreparadocapsula/{preparado_id}/',[RecetaController::class,'updateMateriaPrima'])->name('receta.updateMateriaPrima');
Route::delete('/receta/indexpreparadocapsula/{preparado_id}/{receta_id}', [RecetaController::class, 'destroyMateriaPrima'])->name('receta.preparadocapsula.destroyMateriaPrima');

Route::get('/receta/etiquetaizquierda/{id}/{i}',[RecetaController::class,'etiquetaizquierda'])->name('receta.etiquetaizquierda');
Route::get('/receta/etiquetaderecha/{id}/{i}',[RecetaController::class,'etiquetaderecha'])->name('receta.etiquetaderecha');

Route::get('/receta/generatepdf/{id}',[RecetaController::class,'generatepdf'])->name('receta.etiqueta.etiquetaprueba');



Route::get('/medico',[MedicoController::class,'index'])->name('medico.index');
Route::get('/medico/crear',[MedicoController::class,'create'])->name('medico.create');
Route::post('/medico/guardar',[MedicoController::class,'store'])->name('medico.store');
Route::get('/medico/editar/{id}',[MedicoController::class,'edit'])->name('medico.edit');
Route::put('/medico/actualizar/{id}', [MedicoController::class, 'update'])->name('medico.update');
Route::delete('/medico/eliminar/{id}', [MedicoController::class, 'destroy'])->name('medico.destroy');

Route::get('/materia_prima',[MateriaprimaController::class,'index'])->name('materia_prima.index');
Route::get('/materia_prima/crear',[MateriaprimaController::class,'create'])->name('materia_prima.create');
Route::post('/materia_prima/guardar',[MateriaprimaController::class,'store'])->name('materia_prima.store');
Route::get('/materia_prima/editar/{id}',[MateriaprimaController::class,'edit'])->name('materia_prima.edit');
Route::put('/materia_prima/actualizar/{id}', [MateriaprimaController::class, 'update'])->name('materia_prima.update');
Route::delete('/materia_prima/eliminar/{id}', [MateriaprimaController::class, 'destroy'])->name('materia_prima.destroy');

Route::post('/posicion/{cotizacion_id}',  [ReporteController::class, 'solicitaretiqueta'])->name('orden_trabajo.solicitaretiqueta');

Route::get('/orden_trabajo',[OrdenTrabajoController::class,'index'])->name('orden_trabajo.index');
Route::get('/orden_trabajo/guardarOC',[OrdenTrabajoController::class,'guardarOC'])->name('ordenTrabajo.guardarOC');
Route::put('/orden_trabajo/actualizar/{id}', [OrdenTrabajoController::class, 'updateEstado'])->name('orden_trabajo.updateEstado');
Route::put('/lote_serie/actualizar/{id}', [OrdenTrabajoController::class, 'updateLoteSerie'])->name('orden_trabajo.updateLoteSerie');

Route::get('/orden_entrega',[OrdenEntregaController::class,'index'])->name('orden_entrega.index');
Route::put('/orden_entrega/actualizar/{id}', [OrdenEntregaController::class, 'updateEstado'])->name('orden_entrega.updateEstado');



Route::get('/productos',Productos::class);
Route::get('/reportesMp',[ReporteController::class, 'reportesMp'])->name('reportesMp.index');
Route::get('/reportesMp/index2',[ReporteController::class, 'reportesMp_ver'])->name('reportesMp.index2');

Route::get('/reportesLr',[ReporteController::class, 'reportesLr'])->name('reportesLr.index');
Route::get('/reportesLr/index2',[ReporteController::class, 'reportesLr_ver'])->name('reportesLr.index2');

Route::get('/reportesLc',[ReporteController::class, 'reportesLc'])->name('reportesLc.index');
Route::get('/reportesLc/index2',[ReporteController::class, 'reportesLc_ver'])->name('reportesLc.index2');


Route::get('/reportes_internos',[ReporteController::class, 'reportes_internos'])->name('reportes_internos.index');
Route::get('/reportesMp/{cotizacion_id}',[ReporteController::class, 'solicitarposicion'])->name('reportesMp.solicitarposicion');
Route::get('/reportesimprimir/{cotizacion_id}',[ReporteController::class, 'imprimiretiqueta'])->name('reporte.imprimiretiqueta');


Route::get('/empresas',[EmpresaController::class,'index'])->name('empresas.index');
Route::get('/empresas/crear',[EmpresaController::class,'create'])->name('empresas.create');
Route::post('/empresas/guardar',[EmpresaController::class,'store'])->name('empresas.store');
Route::get('/empresas/editar/{id}',[EmpresaController::class,'edit'])->name('empresas.edit');
Route::put('/empresas/actualizar/{id}', [EmpresaController::class, 'update'])->name('empresas.update');
Route::delete('/empresas/eliminar/{id}', [EmpresaController::class, 'destroy'])->name('empresas.destroy');

Route::get('/entradaencabezado',[EntradaController::class,'index'])->name('entrada.encabezado.index');
Route::get('/entradaencabezado/crear',[EntradaController::class,'create'])->name('entrada.encabezado.create');
Route::post('/entradaencabezado/guardar',[EntradaController::class,'store'])->name('entrada.encabezado.store');
Route::get('/entradaencabezado/editar/{id}',[EntradaController::class,'edit'])->name('entrada.encabezado.edit');
Route::put('/entradaencabezado/actualizar/{id}', [EntradaController::class, 'update'])->name('entrada.encabezado.update');
Route::delete('/entradaencabezado/eliminar/{id}', [EntradaController::class, 'destroy'])->name('entrada.encabezado.destroy');

Route::get('/entradadetalle/{id}',[DetalleEntradaController::class,'index'])->name('entrada.detalle.index');
Route::get('/entradadetalle/crear/{id}',[DetalleEntradaController::class,'create'])->name('entrada.detalle.create');
Route::post('/entradadetalle/guardar',[DetalleEntradaController::class,'store'])->name('entrada.detalle.store');
Route::get('/entradadetalle/editar/{id}',[DetalleEntradaController::class,'edit'])->name('entrada.detalle.edit');
Route::put('/entradadetalle/actualizar/{id}', [DetalleEntradaController::class, 'update'])->name('entrada.detalle.update');
Route::delete('/entradadetalle/eliminar/{id}', [DetalleEntradaController::class, 'destroy'])->name('entrada.detalle.destroy');
Route::get('/materia_prima_status',[DetalleEntradaController::class,'mp_status_index'])->name('entrada.detalle.mp_status_index');
Route::get('/materia_prima_status/status_en_uso',[DetalleEntradaController::class,'UpdateStatusEnUso'])->name('entrada.detalle.status_en_uso');


Route::get('/salidaencabezado',[SalidaController::class,'index'])->name('salida.encabezado.index');
Route::get('/salidaencabezado/crear',[SalidaController::class,'create'])->name('salida.encabezado.create');
Route::post('/salidaencabezado/guardar',[SalidaController::class,'store'])->name('salida.encabezado.store');
Route::get('/salidaencabezado/editar/{id}',[SalidaController::class,'edit'])->name('salida.encabezado.edit');
Route::put('/salidaencabezado/actualizar/{id}', [SalidaController::class, 'update'])->name('salida.encabezado.update');
Route::delete('/salidaencabezado/eliminar/{id}', [SalidaController::class, 'destroy'])->name('salida.encabezado.destroy');

Route::get('/salidadetalle/{id}',[DetalleSalidaController::class,'index'])->name('salida.detalle.index');
Route::get('/salidadetalle/crear/{id}',[DetalleSalidaController::class,'create'])->name('salida.detalle.create');
Route::post('/salidadetalle/guardar',[DetalleSalidaController::class,'store'])->name('salida.detalle.store');
Route::get('/salidadetalle/editar/{id}',[DetalleSalidaController::class,'edit'])->name('salida.detalle.edit');
Route::put('/salidadetalle/actualizar/{id}', [DetalleSalidaController::class, 'update'])->name('salida.detalle.update');
Route::delete('/salidadetalle/eliminar/{id}', [DetalleSalidaController::class, 'destroy'])->name('salida.detalle.destroy');


Route::get('/responsable',[ResponsableController::class,'index'])->name('responsable.index');
Route::get('/responsable/crear',[ResponsableController::class,'create'])->name('responsable.create');
Route::post('/responsable/guardar',[ResponsableController::class,'store'])->name('responsable.store');
Route::get('/responsable/editar/{id}',[ResponsableController::class,'edit'])->name('responsable.edit');
Route::put('/responsable/actualizar/{id}', [ResponsableController::class, 'update'])->name('responsable.update');
Route::delete('/responsable/eliminar/{id}', [ResponsableController::class, 'destroy'])->name('responsable.destroy');

Route::get('/historial_precio',[HistorialPrecioController::class,'index'])->name('historial_precio.index');
Route::get('/historial_precio/crear',[HistorialPrecioController::class,'create'])->name('historial_precio.create');
Route::post('/historial_precio/guardar',[HistorialPrecioController::class,'store'])->name('historial_precio.store');
Route::get('/historial_precio/editar/{id}',[HistorialPrecioController::class,'edit'])->name('historial_precio.edit');
Route::put('/historial_precio/actualizar/{id}', [HistorialPrecioController::class, 'update'])->name('historial_precio.update');
Route::delete('/historial_precio/eliminar/{id}', [HistorialPrecioController::class, 'destroy'])->name('historial_precio.destroy');


Route::get('/receta_fecha',[ReporteController::class, 'reportes_receta'])->name('receta_fecha.index');
Route::get('/receta_fecha/index2',[ReporteController::class, 'corregir_receta'])->name('receta_fecha.index2');


Route::get('/test/', function () {
    $pdf = PDF::loadView('pruebaparapdf');
    return $pdf->download('pruebapdf.pdf');
  });

});

Route::get('pdf_der/{posiY}', [PdfController::class, 'pdfDerecha']);
Route::get('pdf_izq/{posiY}', [PdfController::class, 'pdfIzquierda']);
