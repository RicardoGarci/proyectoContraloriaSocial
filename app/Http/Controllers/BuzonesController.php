<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buzone;
use App\Models\ComentariosBuzone;
use App\Models\CatalogoDependencia;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use RealRashid\SweetAlert\Facades\Alert;

class BuzonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buzones = Buzone::BuzonTipo()->get();
        return view('AtencionC/buzones')->with('buzones', $buzones);
    }

    public function obtenerTiposBuzon($tipo)
    {
        $resultados = CatalogoDependencia::where('tipo', $tipo)->get();
        return response()->json($resultados);
    }

    public function registrarTiposBuzon(Request $request)
    {
        $registro = new CatalogoDependencia();
        $registro->tipo = $request->input('txtAgregarTipo');
        $registro->nombre_dependecia_programa = $request->input('nombre_dpm');
        $registro->save();

        Alert::success('Registro correcto', 'La Dependencia, Programa o Municipio fue registrado de manera satisfactoria');
        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function informes()
    {
        $buzones = ComentariosBuzone::ContarComentariosPorDependencia()->get();
        $conteoPorTipo = ComentariosBuzone::contarPorTipoComentario()->get();
        $conteoPorRegion = Buzone::ContarPorRegion()->get();
        return view('AtencionC/informes')->with('buzones', $buzones)->with('conteoPorTipo', $conteoPorTipo)->with('conteoPorRegion', $conteoPorRegion);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $registro = new Buzone();
        $registro->numero_buzon = strtoupper($request->input('txtBuzon'));
        $registro->id_catalogo_buzon_fk = $request->input('txtTipoBuzon');
        $registro->ubicacion = $request->input('txtUbicacion');
        $registro->region = $request->input('region');
        $registro->save();

        Alert::success('Buzón Registrado', 'El buzón digital fue registrado de manera satisfactoria');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $registro = Buzone::find($id);
        $registro->numero_buzon = strtoupper($request->input('txtFolio'));
        $registro->ubicacion = $request->input('txtubicacion');
        $registro->save();

        Alert::success('Buzón actualizado', 'El buzón digital fue actualizado de manera satisfactoria');
        return back();
    }

    public function descargarQR($id)
    {
        $textoQR = route('buzones_ciudadanos.edit', $id);

        $codigoQR = QrCode::format('png')->margin(0)->size(500)->color(157, 36, 73)->generate($textoQR);

        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="codigo_qr.png"',
        ];

        // Devolver la respuesta con la imagen del código QR
        return response($codigoQR, 200, $headers);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
