<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\EvaluarparaMejorar;
use App\Models\ProgramacionEvaluacione;
use Carbon\Carbon;
use Auth;

class EvaluarparaMejorarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function viewEvaluarparaMejorar()
    {
        $fechaActual = Carbon::now();
        $elemento = ProgramacionEvaluacione::where('fecha_inicio', '<=', $fechaActual)->where('fecha_fin', '>=', $fechaActual)->value('id_programacion');

        if (is_null($elemento)) {
            Alert::error('Sin encuesta programada', 'No se encuentra ninguna evaluación programada para estas fechas.');
            return back();
        } else {
            return view('AtencionC/evaluarparamejorar');
        }
    }
    public function guardarRespuestasEvaluarparaMejorar(Request $request)
    {
        $fechaActual = Carbon::now();
        $elemento = ProgramacionEvaluacione::where('fecha_inicio', '<=', $fechaActual)->where('fecha_fin', '>=', $fechaActual)->value('id_programacion');

        $evaluarparaMejorar = new EvaluarparaMejorar();
        $evaluarparaMejorar->id_programacion_fk = $elemento;
        $evaluarparaMejorar->id_user_fk = Auth::id();
        $evaluarparaMejorar->oficina = $request->input('oficina');
        $evaluarparaMejorar->sexo = $request->input('sexo');
        $evaluarparaMejorar->tramite_servicio = $request->input('tipo');
        $evaluarparaMejorar->pregunta1 = $request->input('informacion1') . $request->input('otroInput');
        $evaluarparaMejorar->pregunta2 = $request->input('informacion2');
        $evaluarparaMejorar->pregunta3 = $request->input('informacion3');
        $evaluarparaMejorar->pregunta4 = $request->input('informacion4');
        $evaluarparaMejorar->pregunta5 = $request->input('informacion5');
        $evaluarparaMejorar->pregunta6 = $request->input('informacion6');
        $evaluarparaMejorar->pregunta7 = $request->input('informacion7') . $request->input('otroInputDos');
        $evaluarparaMejorar->pregunta8 = $request->input('informacion8');
        $evaluarparaMejorar->pregunta9 = $request->input('informacion9');
        $evaluarparaMejorar->pregunta10 = $request->input('informacion10');
        $evaluarparaMejorar->pregunta11 = $request->input('informacion11');
        $evaluarparaMejorar->pregunta12 = $request->input('informacion12');
        $evaluarparaMejorar->pregunta13 = $request->input('informacion13');
        $evaluarparaMejorar->pregunta14 = $request->input('informacion14') . $request->input('otroInputTres');

        $evaluarparaMejorar->save();

        Alert::success('Evaluación Terminada', 'El usuario realizo correctamente la evaluación');
        return back();
    }

    public function ResultadosEncuesta($id)
    {
        $encuestas = EvaluarparaMejorar::where('id_programacion_fk', $id)->get();
        $total = $encuestas->count();
        $si = 0;
        foreach ($encuestas as $cc) {
            if ($cc->pregunta2 == 'SI') {
                $si++;
            }
            if ($cc->pregunta3 == 'NO') {
                $si++;
            }
            if ($cc->pregunta4 == 'SI') {
                $si++;
            }
            if ($cc->pregunta5 == 'SI') {
                $si++;
            }
            if ($cc->pregunta6 == 'SATISFECHO') {
                $si++;
            }
            if ($cc->pregunta7 == 'NO') {
                $si++;
            }
            if ($cc->pregunta8 == 'SI') {
                $si++;
            }
            if ($cc->pregunta9 == 'NO') {
                $si++;
            }
            if ($cc->pregunta10 == 'NO') {
                $si++;
            }
            if ($cc->pregunta11 == 'NO') {
                $si++;
            }
            if ($cc->pregunta12 == 'SI') {
                $si++;
            }
            if ($cc->pregunta13 == 'SI') {
                $si++;
            }
        }

        $totaciertos = $total * 12;

        if ($totaciertos != 0) {
            $promedio = intval(round(($si * 10) / $totaciertos));
        } else {
            $promedio = 0;
        }

        if ($total > 0) {
            return view('AtencionC/informesEncuestasEpM', compact('id', 'total', 'promedio'));
        } else {
            Alert::error('No se tiene registrada ninguna encuesta aun.', null);
            return back();
        }
    }
}
