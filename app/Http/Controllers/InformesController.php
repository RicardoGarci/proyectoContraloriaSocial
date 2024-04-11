<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CatalogoMunicipio;

class InformesController extends Controller
{
    public function resumenAcreditaciones()
    {
        $defaultYear = date('Y');
        //resumen acreditaciones
        $totComites = CatalogoMunicipio::ContarPorRegion($defaultYear)->get();
        $totintegrantes = CatalogoMunicipio::ContarPorIntegrantes($defaultYear)->get();
        //resumen acreditaciones mensuales
        $comitesMensual = CatalogoMunicipio::ConteoComitesMensual($defaultYear)->get();
        $contraloresMensual = CatalogoMunicipio::ConteoContraloresMensual($defaultYear)->get();
        $meses = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre',
        ];

        return view('Municipios/ResumenAcreditaciones', compact('totComites', 'totintegrantes', 'comitesMensual', 'contraloresMensual', 'meses'));
    }
}
