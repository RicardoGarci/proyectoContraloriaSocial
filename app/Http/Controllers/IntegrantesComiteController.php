<?php

namespace App\Http\Controllers;

use App\Models\IntegrantesComite;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Models\AcreditacionComite;

class IntegrantesComiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        if (empty($request->all())) {
            Alert::error('Error', 'No puedes enviar el formulario vacío');
            return back();
        }
        $registro = new IntegrantesComite();
        $registro->id_acreditacion_comite_fk = $request->input('id_comite');
        $registro->nombre_completo = $request->input('nombre');
        $registro->sexo = $request->input('sexo');
        $registro->fecha_nacimiento = $request->input('fecha_nacimiento');
        $registro->ocupacion = $request->input('ocupacion');
        $registro->escolaridad = $request->input('escolaridad');
        $registro->lengua_indigena = $request->input('lengua_indigena');
        $registro->usa_computadora = $request->input('usa_computadora');
        $registro->domicilio = $request->input('domicilio');
        $registro->telefono = $request->input('telefono_fijo');
        $registro->celular = $request->input('telefono_celular');
        $registro->correo = $request->input('correo');
        $registro->acceso_internet = $request->input('acceso_internet');
        $registro->observacion_identificacion = $request->input('obs_identificacion');
        $registro->observacion_fotografia = $request->input('obs_fotografia');
        $registro->observacion_carta = $request->input('obs_carta');
        $registro->observacion_constancia = $request->input('obs_constancia');
        $registro->save();

        $integrantes = IntegrantesComite::ContarPorComite(now()->year, $request->input('id_comite'))->count();
        if ($integrantes >= 2) {
            $dato = AcreditacionComite::find($request->input('id_comite'));
            $dato->estatus = '1';
            $dato->save();
        }
        Alert::success('Integrante agregado', null);
        return back();
    }

    public function subirDocumentacionIntegrantes(Request $request, $id)
    {
        $dato = IntegrantesComite::find($id);
        $id_comite = $dato->id_acreditacion_comite_fk;
        $ruta = 'comites/' . now()->year . '/' . $id_comite . '/integrantes/' . $id;
        $nombreArchivo = null;

        if ($request->input('tipo') == 'ine' && ($request->hasFile('archivo_ine') && $request->file('archivo_ine')->isValid())) {
            $nombreArchivo = $request->file('archivo_ine')->store($ruta, 'public');
        } elseif ($request->input('tipo') == 'protesta' && ($request->hasFile('archivo_protesta') && $request->file('archivo_protesta')->isValid())) {
            $nombreArchivo = $request->file('archivo_protesta')->store($ruta, 'public');
        } elseif ($request->input('tipo') == 'constancia' && ($request->hasFile('archivo_constancia') && $request->file('archivo_constancia')->isValid())) {
            $nombreArchivo = $request->file('archivo_constancia')->store($ruta, 'public');
        } elseif ($request->input('tipo') == 'fotografia' && ($request->hasFile('archivo_fotografia') && $request->file('archivo_fotografia')->isValid())) {
            $nombreArchivo = $request->file('archivo_fotografia')->store($ruta, 'public');
        }

        if (Storage::disk('public')->exists($nombreArchivo)) {
            if ($request->input('tipo') == 'ine') {
                $dato->archivo_ine = $nombreArchivo;
            } elseif ($request->input('tipo') == 'protesta') {
                $dato->archivo_protesta = $nombreArchivo;
            } elseif ($request->input('tipo') == 'constancia') {
                $dato->archivo_constancia = $nombreArchivo;
            } elseif ($request->input('tipo') == 'fotografia') {
                $dato->archivo_fotografia = $nombreArchivo;
            }
            $dato->save();

            //VERIFICA SI ESTAN LOS ARCHIVOS DE LOS INTEGRANTES COMPLETOS
            $resultado = IntegrantesComite::ContarPorComite(now()->year, $id_comite)->get();
            $todosRellenados = $resultado->every(function ($item) {
                return $item->archivo_ine !== null && $item->archivo_protesta !== null && $item->archivo_constancia !== null && $item->archivo_fotografia !== null;
            });
            $variable = $todosRellenados ? 1 : 0;
            $doc = AcreditacionComite::where('id_acreditacion', $id_comite)->first();

            //FIN DE LA VERIFICACION

            if (!empty($doc->archivo_acta) && !empty($doc->archivo_lista) and $variable == 1) {
                $doc->estatus = '3';
                $doc->save();
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function eliminarDocumentacionIntegrantes($id)
    {
        $tipo = substr($id, 0, 1);
        $idd = substr($id, 1);
        $documento = IntegrantesComite::find($idd);
        $id_comite = $documento->id_acreditacion_comite_fk;

        if (!$documento) {
            Alert::error('Error', 'Archivo no encontrado');
            return back();
        }

        if ($tipo == 1) {
            Storage::disk('public')->delete($documento->archivo_ine);
            $documento->archivo_ine = null;
        } elseif ($tipo == 2) {
            Storage::disk('public')->delete($documento->archivo_protesta);
            $documento->archivo_protesta = null;
        } elseif ($tipo == 3) {
            Storage::disk('public')->delete($documento->archivo_constancia);
            $documento->archivo_constancia = null;
        } elseif ($tipo == 4) {
            Storage::disk('public')->delete($documento->archivo_fotografia);
            $documento->archivo_fotografia = null;
        }
        $documento->save();

        $resultado = IntegrantesComite::ContarPorComite(now()->year, $id_comite)->get();
        $todosRellenados = $resultado->every(function ($item) {
            return $item->archivo_ine !== null && $item->archivo_protesta !== null && $item->archivo_constancia !== null && $item->archivo_fotografia !== null;
        });
        $variable = $todosRellenados ? 1 : 0;
        $doc = AcreditacionComite::where('id_acreditacion', $id_comite)->first();

        if (!empty($doc->archivo_acta) && !empty($doc->archivo_lista)) {
            $doc->estatus = '5';
            $doc->save();
        }

        Alert::success('Documentación eliminada', null);
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
        $integrantes = IntegrantesComite::where('id_acreditacion_comite_fk', $id)->get();
        $doc = AcreditacionComite::where('id_acreditacion', $id)->first();
        $estatus = $doc->estatus;
        return view('Municipios/integrantesComite', compact('id', 'estatus'))->with('integrantes', $integrantes);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dato = IntegrantesComite::find($id);

        if ($request->filled('nombre')) {
            $dato->nombre_completo = $request->input('nombre');
        }
        if ($request->filled('sexo')) {
            $dato->sexo = $request->input('sexo');
        }
        if ($request->filled('fecha_nacimiento')) {
            //$dato->fecha_nacimiento = $request->input('fecha_nacimiento');
            $dato->fecha_nacimiento = date('Y-m-d', strtotime(str_replace('/', '-', $request->input('fecha_nacimiento'))));
        }
        if ($request->filled('ocupacion')) {
            $dato->ocupacion = $request->input('ocupacion');
        }
        if ($request->filled('escolaridad')) {
            $dato->escolaridad = $request->input('escolaridad');
        }
        if ($request->filled('lengua_indigena')) {
            $dato->lengua_indigena = $request->input('lengua_indigena');
        }
        if ($request->filled('usa_computadora')) {
            $dato->usa_computadora = $request->input('usa_computadora');
        }
        if ($request->filled('domicilio')) {
            $dato->domicilio = $request->input('domicilio');
        }
        if ($request->filled('telefono_fijo')) {
            $dato->telefono = $request->input('telefono_fijo');
        }
        if ($request->filled('telefono_celular')) {
            $dato->celular = $request->input('telefono_celular');
        }
        if ($request->filled('correo')) {
            $dato->correo = $request->input('correo');
        }
        if ($request->filled('acceso_internet')) {
            $dato->acceso_internet = $request->input('acceso_internet');
        }
        if ($request->filled('obs_identificacion')) {
            $dato->observacion_identificacion = $request->input('obs_identificacion');
        }
        if ($request->filled('obs_fotografia')) {
            $dato->observacion_fotografia = $request->input('obs_fotografia');
        }
        if ($request->filled('obs_carta')) {
            $dato->observacion_carta = $request->input('obs_carta');
        }
        if ($request->filled('obs_constancia')) {
            $dato->observacion_constancia = $request->input('obs_constancia');
        }

        $dato->save();
        Alert::success('Información actualizada', null);
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
        $integrante = IntegrantesComite::find($id);
        if ($integrante) {
            $integrante->delete();

            Alert::success('Éxito', 'El usuario se ha eliminado con éxito');
            return back();
        } else {
            Alert::error('Error', 'No se pudo eliminar el usuario');
            return back();
        }
    }
}
