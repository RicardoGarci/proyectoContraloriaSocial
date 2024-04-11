<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\CatalogoMunicipio;

class MunicipioController extends Controller
{
    public function index()
    {
        $catalogo = CatalogoMunicipio::get();
        //dd($catalogo);
        return view('Municipios/CatalogoMunicipios')->with('catalogo', $catalogo);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'txtFolio' => ['nullable', 'regex:/^[A-Za-z\s]+$/'],
                'txtMunicipio' => ['nullable', 'regex:/^[A-Za-z\s]+$/'],
                'txtRegion' => ['nullable', 'regex:/^[A-Za-z\s]+$/'],
                'txtDistrito' => ['nullable', 'regex:/^[A-Za-z\s]+$/'],
            ]);

            if ($validator->fails()) {
                Alert::info('El campo contiene caracteres especiales o números.', null);
                return back();
            }

            $dato = CatalogoMunicipio::find($id);

            if ($request->filled('txtFolio')) {
                $dato->folio = $request->input('txtFolio');
            }

            if ($request->filled('txtMunicipio')) {
                $dato->nombre = $request->input('txtMunicipio');
            }

            if ($request->filled('txtRegion')) {
                $dato->region = $request->input('txtRegion');
            }

            if ($request->filled('txtDistrito')) {
                $dato->distrito = $request->input('txtDistrito');
            }

            $dato->save();

            Alert::success('Municipio Guardado', 'Los datos se han guardado correctamente.');
            return back();
        } catch (\Exception $e) {
            Alert::error('Ha ocurrido un error al actualizar los datos.', null);
            return back();
        }
    }
}
