<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\VerificacionFisica;
use App\Models\ProgramacionEvaluacione;
use Carbon\Carbon;
use Auth;

class VerificacionFisicaController extends Controller
{
    public function viewDireccionFisica()
    {
        $fechaActual = Carbon::now();
        $elemento = ProgramacionEvaluacione::where('fecha_inicio', '<=', $fechaActual)->where('fecha_fin', '>=', $fechaActual)->value('id_programacion');

        if (is_null($elemento)) {
            Alert::error('Sin encuesta programada', 'No se encuentra ninguna evaluación programada para estas fechas.');
            return back();
        } else {
            return view('AtencionC/verificacionFisica');
        }
    }

    public function guardarRespuestasDireccionFisica(Request $request)
    {
        try {
            $respuestas = $request->input();

            $reglas = [
                'informacion0' => 'required',
                'informacion1' => 'required',
                'informacion2' => 'required',
                'informacion3' => 'required',
                'informacion4' => 'required',
                'informacion5' => 'required',
                'informacion6' => 'required',
                'informacion7' => 'required',
                'informacion8' => 'required',
                'informacion9' => 'required',
                'informacion10' => 'required',
                'informacion11' => 'required',
                'informacion12' => 'required',
                'informacion13' => 'required',
                'informacion14' => 'required',
                'informacion15' => 'required',
                'mecanismos0' => 'required',
                'accesibilidad0' => 'required',
                'accesibilidad1' => 'required',
                'accesibilidad2' => 'required',
                'accesibilidad3' => 'required',
                'accesibilidad4' => 'required',
                'infraestructura0' => 'required',
                'infraestructura1' => 'required',
            ];

            $mensajes = [
                'required' => 'El campo :attribute es obligatorio.',
            ];
            $validator = Validator::make($respuestas, $reglas, $mensajes);

            if ($validator->fails()) {
                Alert::error('Faltan respuestas', 'Por favor, complete todas las respuestas antes de enviar la evaluación.');
                return back()->withErrors($validator)->withInput();
            }

            $fechaActual = Carbon::now();
            $elemento = ProgramacionEvaluacione::where('fecha_inicio', '<=', $fechaActual)->where('fecha_fin', '>=', $fechaActual)->value('id_programacion');

            $verificacionFisica = new VerificacionFisica();
            $verificacionFisica->id_programacion_fk = $elemento;
            $verificacionFisica->id_user_fk = Auth::id();
            $verificacionFisica->oficina = $request->input('oficina');
            $verificacionFisica->num_modulo = $request->input('num_modulo');
            $verificacionFisica->info1 = $respuestas['informacion0'];
            $verificacionFisica->info2 = $respuestas['informacion1'];
            $verificacionFisica->info3 = $respuestas['informacion2'];
            $verificacionFisica->info4 = $respuestas['informacion3'];
            $verificacionFisica->info5 = $respuestas['informacion4'];
            $verificacionFisica->info6 = $respuestas['informacion5'];
            $verificacionFisica->info7 = $respuestas['informacion6'];
            $verificacionFisica->info8 = $respuestas['informacion7'];
            $verificacionFisica->info9 = $respuestas['informacion8'];
            $verificacionFisica->info10 = $respuestas['informacion9'];
            $verificacionFisica->info11 = $respuestas['informacion10'];
            $verificacionFisica->info12 = $respuestas['informacion11'];
            $verificacionFisica->info13 = $respuestas['informacion12'];
            $verificacionFisica->info14 = $respuestas['informacion13'];
            $verificacionFisica->info15 = $respuestas['informacion14'];
            $verificacionFisica->info16 = $respuestas['informacion15'];
            $verificacionFisica->meca1 = $respuestas['mecanismos0'];
            $verificacionFisica->access1 = $respuestas['accesibilidad0'];
            $verificacionFisica->access2 = $respuestas['accesibilidad1'];
            $verificacionFisica->access3 = $respuestas['accesibilidad2'];
            $verificacionFisica->access4 = $respuestas['accesibilidad3'];
            $verificacionFisica->access5 = $respuestas['accesibilidad4'];
            $verificacionFisica->infra1 = $respuestas['infraestructura0'];
            $verificacionFisica->infra2 = $respuestas['infraestructura1'];

            $verificacionFisica->save();

            Alert::success('Evaluación Terminada', 'El usuario realizo correctamente la evaluación');
            return back();
        } catch (\Exception $e) {
            dd($e->getMessage());
            Alert::error('Ha ocurrido un error al enviar las respuestas de la evaluación.', null);
            return back();
        }
    }

    public function ResultadosEncuesta($id)
    {
        $encuestas = VerificacionFisica::where('id_programacion_fk', $id)->get();
        $total = $encuestas->count();
        $si = 0;
        foreach ($encuestas as $cc) {
            if ($cc->info1 == 'SI') {
                $si++;
            }
            if ($cc->info2 == 'SI') {
                $si++;
            }
            if ($cc->info3 == 'SI') {
                $si++;
            }
            if ($cc->info4 == 'SI') {
                $si++;
            }
            if ($cc->info5 == 'SI') {
                $si++;
            }
            if ($cc->info6 == 'SI') {
                $si++;
            }
            if ($cc->info7 == 'SI') {
                $si++;
            }
            if ($cc->info8 == 'SI') {
                $si++;
            }
            if ($cc->info9 == 'SI') {
                $si++;
            }
            if ($cc->info10 == 'SI') {
                $si++;
            }
            if ($cc->info11 == 'SI') {
                $si++;
            }
            if ($cc->info12 == 'SI') {
                $si++;
            }
            if ($cc->info13 == 'NO') {
                $si++;
            }
            if ($cc->info14 == 'NO') {
                $si++;
            }
            if ($cc->info15 == 'NO') {
                $si++;
            }
            if ($cc->info16 == 'NO') {
                $si++;
            }
            if ($cc->meca1 == 'SI') {
                $si++;
            }
            if ($cc->access1 == 'SI') {
                $si++;
            }
            if ($cc->access2 == 'SI') {
                $si++;
            }
            if ($cc->access3 == 'SI') {
                $si++;
            }
            if ($cc->access4 == 'SI') {
                $si++;
            }
            if ($cc->access5 == 'SI') {
                $si++;
            }
            if ($cc->infra1 == 'SI') {
                $si++;
            }
            if ($cc->infra2 == 'SI') {
                $si++;
            }
        }

        $totaciertos = $total * 24;

        if ($totaciertos != 0) {
            $promedio = intval(round(($si * 10) / $totaciertos));
        } else {
            $promedio = 0;
        }

        if ($total > 0) {
            return view('AtencionC/informesEncuestas', compact('id', 'total', 'promedio'));
        } else {
            Alert::error('No se tiene registrada ninguna encuesta aun.', null);
            return back();
        }
    }
}
