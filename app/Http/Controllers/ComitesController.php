<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatalogoMunicipio;
use App\Models\User;
use App\Models\AcreditacionComite;
use RealRashid\SweetAlert\Facades\Alert;
use Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\IntegrantesComite;

class ComitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $municipios = CatalogoMunicipio::ConAcreditacionComites(now()->year)->get();
        return view('Municipios/comites')->with('municipios', $municipios);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function crearComite($id)
    {
        $municipio = CatalogoMunicipio::where('id_municipio', $id)->first();
        $municipio = $municipio->nombre;
        $edicion = '--';
        return view('Municipios/registroComite', compact('municipio', 'id', 'edicion'));
    }

    public function subirDocumentacion(Request $request, $id)
    {
        $dato = AcreditacionComite::find($id);
        $ruta = 'comites/' . now()->year . '/' . $id;
        $nombreArchivo = null;

        if ($request->input('tipo') == 'acta' && ($request->hasFile('archivo_acta') && $request->file('archivo_acta')->isValid())) {
            $nombreArchivo = $request->file('archivo_acta')->store($ruta, 'public');
        } elseif ($request->input('tipo') == 'lista' && ($request->hasFile('archivo_lista') && $request->file('archivo_lista')->isValid())) {
            $nombreArchivo = $request->file('archivo_lista')->store($ruta, 'public');
        }

        if (Storage::disk('public')->exists($nombreArchivo)) {
            if ($request->input('tipo') == 'acta') {
                $dato->archivo_acta = $nombreArchivo;
            } elseif ($request->input('tipo') == 'lista') {
                $dato->archivo_lista = $nombreArchivo;
            }
            $dato->save();

            //VERIFICA SI ESTAN LOS ARCHIVOS DE LOS INTEGRANTES COMPLETOS
            $resultado = IntegrantesComite::ContarPorComite(now()->year, $id)->get();
            $variable = 0;

            if (!empty($resultado->id_integrante_comite)) {
                $todosRellenados = $resultado->every(function ($item) {
                    return $item->archivo_ine !== null && $item->archivo_protesta !== null && $item->archivo_constancia !== null && $item->archivo_fotografia !== null;
                });

                $variable = $todosRellenados ? 1 : 0;
            }

            //FIN DE LA VERIFICACION
            if ((!empty($dato->archivo_acta) && !empty($dato->archivo_lista)) || $variable == 1) {
                $dato->estatus = '3';
                $dato->save();
            } elseif (!empty($dato->archivo_acta) && !empty($dato->archivo_lista)) {
                $dato->estatus = '2';
                $dato->save();
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function eliminarDocumentacion($id)
    {
        $tipo = substr($id, 0, 1);
        $idd = substr($id, 1);
        $documento = AcreditacionComite::find($idd);

        if (!$documento) {
            Alert::error('Error', 'Archivo no encontrado');
            return back();
        }

        if ($tipo == 1) {
            Storage::disk('public')->delete($documento->archivo_acta);
            $documento->archivo_acta = null;
        } elseif ($tipo == 2) {
            Storage::disk('public')->delete($documento->archivo_lista);
            $documento->archivo_lista = null;
        }
        $documento->estatus = 5;

        $documento->save();

        Alert::success('Documentación eliminada', null);
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valida = AcreditacionComite::where('id_catalogo_municipio_fk',$request->input('municipio'))->where('ejercicio',now()->year)->get();

        if( $valida->isEmpty()){
            $registro = new AcreditacionComite();
        $registro->id_catalogo_municipio_fk = $request->input('municipio');
        $registro->ejercicio = now()->year;
        $registro->nombramiento = $request->input('nombramiento');
        $registro->acreditacion = $request->input('acreditacion');
        $registro->elaboracion_acreditacion = $request->input('elaboracion');
        $registro->acredito_en = $request->input('se_acredito');
        $registro->capacito_comite = $request->input('capacito_comite');
        $registro->id_user_registro_fk = Auth::id();
        $registro->acta_asamblea = $request->input('acta_asamblea');
        $registro->lista_asistencia = $request->input('lista_asamblea');
        $registro->datos_municipio = $request->input('datos_municipio');
        $registro->estatus = 0;
        $registro->save();

        Alert::success('Comité guardado', null);

        } else{
            Alert::error('Acreditación duplicada', 'Ya se encuentra acreditado este municipio');
        }

        
        return redirect()->route('comites.index');
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

    public function validarComite(Request $request, $id)
    {
        $dato = AcreditacionComite::find($id);

        $folioMunicipio = CatalogoMunicipio::where('id_municipio', $dato->id_catalogo_municipio_fk)->first();
        $folioMunicipio = $folioMunicipio->folio;
        $numeroConsecutivo = AcreditacionComite::BuscaEjercicio(now()->year)->count() + 1;
        $numeroConsecutivoFormateado = str_pad($numeroConsecutivo, 3, '0', STR_PAD_LEFT);

        if (is_null($dato->folio_comite)) {
            $dato->folio_comite = $folioMunicipio . ' ' . $numeroConsecutivoFormateado;
        }
        $dato->id_user_valido_fk = Auth::id();
        $dato->estatus = '4';
        $dato->fecha_validado = $request->input('fecha_validacion');
        $dato->save();

        Alert::success('Comité validado', null);
        return redirect()->route('comites.index');
    }

    public function RevisarInformacion($id)
    {
        $dato = AcreditacionComite::find($id);
        $dato->estatus = '5';
        $dato->save();

        Alert::success('Comité en revisión', null);
        return redirect()->route('comites.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dato = AcreditacionComite::find($id);
        $municipio = CatalogoMunicipio::where('id_municipio', $dato->id_catalogo_municipio_fk)->first();
        $municipio = $municipio->nombre;
        $userAtendio = User::where('departamento', 1)->get();
        $atendio = User::find($dato->id_user_registro_fk);
        if (empty($atendio)) {
            $atendio = 'No atendido';
        } else {
            $atendio = $atendio->name;
        }
        $autorizo = User::find($dato->id_user_valido_fk);
        if (empty($autorizo)) {
            $autorizo = 'Sin autorizar';
        } else {
            $autorizo = $autorizo->name;
        }
        $capacito = User::find($dato->id_user_capacito_fk);
        if (empty($capacito)) {
            $capacito = 'Sin capacitar';
            $idCapacito = 0;
        } else {
            $capacito = $capacito->name;
            $idCapacito = $dato->id_user_capacito_fk;
        }
        $edicion = 'edición';
        return view('Municipios/registroComite', compact('municipio', 'id', 'edicion', 'atendio', 'autorizo', 'capacito', 'idCapacito'))->with('dato', $dato)->with('userAtendio', $userAtendio);
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
        $dato = AcreditacionComite::find($id);

        if ($request->filled('nombramiento')) {
            $dato->nombramiento = $request->input('nombramiento');
        }
        if ($request->filled('acreditacion')) {
            $dato->acreditacion = $request->input('acreditacion');
        }
        if ($request->filled('elaboracion')) {
            $dato->elaboracion_acreditacion = $request->input('elaboracion');
        }
        if ($request->filled('se_acredito')) {
            $dato->acredito_en = $request->input('se_acredito');
        }
        if ($request->filled('capacito_comite')) {
            $dato->capacito_comite = $request->input('capacito_comite');
        }
        if ($request->filled('acta_asamblea')) {
            $dato->acta_asamblea = $request->input('acta_asamblea');
        }
        if ($request->filled('lista_asamblea')) {
            $dato->lista_asistencia = $request->input('lista_asamblea');
        }
        if ($request->filled('datos_municipio')) {
            $dato->datos_municipio = $request->input('datos_municipio');
        }
        if ($request->filled('capacito')) {
            $dato->id_user_capacito_fk = $request->input('capacito');
        }

        $dato->save();

        Alert::success('Comité actualizado', null);
        return redirect()->route('comites.index');
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
