<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramacionEvaluacione;
use RealRashid\SweetAlert\Facades\Alert;
use Carbon\Carbon;
use App\Models\VerificacionFisica;
use Illuminate\Support\Facades\Storage;
use App\Models\EvaluarparaMejorar;

class ProgramacionEvaluacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buzones = ProgramacionEvaluacione::TraeDependencias()->get();
        return view('AtencionC/programacionEncuestas')->with('buzones', $buzones);
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
        $registro = new ProgramacionEvaluacione();
        $registro->id_catalogo_dependencias_fk = $request->input('txtTipoBuzon');
        $registro->fecha_inicio = $request->input('fecha_inicio');
        $registro->fecha_fin = $request->input('fecha_fin');
        $registro->tipo_intervencion = $request->input('etapa');

        $fechaActual = Carbon::now();
        $elemento = ProgramacionEvaluacione::where('fecha_inicio', '<=', $fechaActual)->where('fecha_fin', '>=', $fechaActual)->value('id_programacion');

        if (is_null($elemento)) {
            $registro->save();
            Alert::success('Evaluación Programada correctamente', null);
            return back();
        } else {
            Alert::error('Periodo ocupado', 'Ya existe una intervención en las fechas seleccionadas');
            return back();
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
        $primerDigito = substr($id, 0, 1);
        $restoCadena = substr($id, 1);
        if ($primerDigito == 1) {
            $datos = EvaluarparaMejorar::TraeEncuestas($restoCadena)->get();
            return view('AtencionC/verEncuestasEpM')->with('datos', $datos);
        } else {
            $datos = VerificacionFisica::TraeEncuestas($restoCadena)->get();
            return view('AtencionC/verEncuestas')->with('datos', $datos);
        }
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
    }

    public function subirInforme(Request $request, $id)
    {
        $registro = ProgramacionEvaluacione::find($id);

        if ($request->hasFile('archivo_informe') && $request->file('archivo_informe')->isValid()) {
            $ruta = $request->file('archivo_informe')->store('Informes evaluaciones/' . now()->year, 'public');

            if (Storage::disk('public')->exists($ruta)) {
                $registro->informe = $ruta;
                $registro->save();
                Alert::success('Informe cargado correctamente', null);
                return back();
            } else {
                Alert::error('Tuvimos un error al cargar el informe, por favor intenta nuevamente', null);
                return back();
            }
        } else {
            Alert::error('Error', 'No se ha seleccionado ningún archivo válido.');
            return back();
        }
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
        $registro = ProgramacionEvaluacione::find($id);
        $registro->fecha_inicio = $request->input('fecha_inicio');
        $registro->fecha_fin = $request->input('fecha_fin');
        $registro->tipo_intervencion = $request->input('etapa');
        $registro->save();

        Alert::success('Programación de evaluación editada correctamente', null);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dato = ProgramacionEvaluacione::find($id);
            $dato->delete();
            Alert::success('Programación eliminada', null);
            return back();
        } catch (\Exception $e) {
            Alert::error('No se puede eliminar la programación.', null);
            return back();
        }
    }
}
