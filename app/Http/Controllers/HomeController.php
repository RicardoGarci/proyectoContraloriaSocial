<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\IntegrantesComite;
use App\Models\AcreditacionComite;
use App\Models\Buzone;
use App\Models\CatalogoDependencia;
use App\Models\ComentariosBuzone;
use App\Models\EvaluarparaMejorar;
use App\Models\ProgramacionEvaluacione;
use App\Models\VerificacionFisica;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $defaultYear = date('Y');

        if (Auth::user()->rol == 'director' or Auth::user()->rol == 'super') {
            $fechaActual = Carbon::now();
            $totBuzones = Buzone::all()->count();
            $integrantesTotal = IntegrantesComite::IntegrantesTotal($defaultYear)->first();
            $comitesAcreditados = AcreditacionComite::comitesAcreditados($defaultYear, 1)->first();
            $idep = ProgramacionEvaluacione::where('fecha_inicio', '<=', $fechaActual)->where('fecha_fin', '>=', $fechaActual)->first();
            if (is_null($idep)) {
                $evProceso = 'Ninguno';
                $evrealizadas = 0;
            } else {
                $evProceso = CatalogoDependencia::where('id_catalogo_dependencias', $idep->id_catalogo_dependencias_fk)->value('nombre_dependecia_programa');
            }
            return view('/home', compact('comitesAcreditados', 'integrantesTotal', 'totBuzones', 'evProceso'));
        } elseif (Auth::user()->departamento == 1) {
            $comitesAcreditados = AcreditacionComite::comitesAcreditados($defaultYear, 1)->first();
            $comitesNoAcreditados = AcreditacionComite::comitesAcreditados($defaultYear, 2)->first();
            $integrantesTotal = IntegrantesComite::IntegrantesTotal($defaultYear)->first();
            $comites = AcreditacionComite::Comites($defaultYear)->get();
            $contralores = IntegrantesComite::Contralores($defaultYear)->get();
            return view('/Municipios/dashboard', compact('comitesAcreditados', 'comitesNoAcreditados', 'integrantesTotal', 'comites', 'contralores'));
        } elseif (Auth::user()->departamento == 2) {
            $totBuzones = Buzone::all()->count();
            $buzSinLeer = ComentariosBuzone::where('estatus', 0)->count();
            $fechaActual = Carbon::now();
            $idep = ProgramacionEvaluacione::where('fecha_inicio', '<=', $fechaActual)->where('fecha_fin', '>=', $fechaActual)->first();
            if (is_null($idep)) {
                $evProceso = 'Ninguno';
                $evrealizadas = 0;
            } else {
                $evProceso = CatalogoDependencia::where('id_catalogo_dependencias', $idep->id_catalogo_dependencias_fk)->value('nombre_dependecia_programa');
                $vf = VerificacionFisica::where('id_programacion_fk', $idep->id_programacion)->count();
                $epm = EvaluarparaMejorar::where('id_programacion_fk', $idep->id_programacion)->count();
                $evrealizadas = $vf + $epm;
            }
            $dep = Buzone::TodoBuzonDependencia()->get();
            return view('/AtencionC/dashboard', compact('totBuzones', 'buzSinLeer', 'evProceso', 'evrealizadas'))->with('dep', $dep);
        }
    }
}
