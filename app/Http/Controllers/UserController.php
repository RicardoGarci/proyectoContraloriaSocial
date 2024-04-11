<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->administrador()) {
            $catalogo = User::UsuariosParaAdmin(Auth::user()->departamento)->get();
        } elseif (Auth::user()->super()) {
            $catalogo = User::all();
        }
        return view('Usuarios/CatalogoUsuarios')->with('catalogo', $catalogo);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'txtNombre' => ['nullable', 'regex:/^[A-Za-z\s]+$/'],
                    'txtEmail' => ['nullable', 'email'],
                    'txtRol' => ['nullable', 'regex:/^[A-Za-z\s]+$/'],
                ],
                [
                    'txtNombre.regex' => 'El campo nombre debe contener solo letras y espacios.',
                    'txtEmail.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
                    'txtRol.regex' => 'El campo rol debe contener solo letras y espacios.',
                ],
            );

            if ($validator->fails()) {
                Alert::info($validator->errors()->first(), null);
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $catalogo = new User();
            $catalogo->name = $request->input('txtAgregarNombre');
            $catalogo->email = $request->input('txtAgregarEmail');
            $catalogo->password = bcrypt($request->input('txtAgregarContrasena'));
            $catalogo->rol = $request->input('txtAgregarRol');
            if(Auth::user()->departamento == 0)
            {
                $catalogo->departamento = $request->input('txtAgregarDepartamento');
            }else {
                $catalogo->departamento = Auth::user()->departamento;
            }
            $catalogo->save();

            Alert::success('Usuario Agregado', 'El usuario se agregó correctamente');
            return back();
        } catch (\Exception $e) {
            dd($e->getMessage());
            Alert::error('Ha ocurrido un error al agregar el usuario.', null);
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'txtNombre' => ['nullable', 'regex:/^[A-Za-z\s]+$/'],
                    'txtEmail' => ['nullable', 'email'],
                    'txtRol' => ['nullable', 'regex:/^[A-Za-z\s]+$/'],
                ],
                [
                    'txtNombre.regex' => 'El campo nombre debe contener solo letras y espacios.',
                    'txtEmail.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
                    'txtRol.regex' => 'El campo rol debe contener solo letras y espacios.',
                ],
            );

            if ($validator->fails()) {
                Alert::info($validator->errors()->first(), null);
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $dato = User::find($id);

            if ($request->filled('txtNombre')) {
                $dato->nombre = $request->input('txtNombre');
            }
            if ($request->filled('txtEmail')) {
                $dato->email = $request->input('txtEmail');
            }
            if ($request->filled('txtContrasena')) {
                $nuevaContraseña = bcrypt($request->input('txtContrasena'));
                $dato->password = $nuevaContraseña;
            }
            if ($request->filled('txtRol')) {
                $dato->rol = $request->input('txtRol');
            }
            $dato->save();
            Alert::success('Usuario Guardado', 'Los datos se han guardado correctamente.');
            return back();
        } catch (\Exception $e) {
            Alert::error('Ha ocurrido un error al actualizar los datos.', null);
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $dato = User::find($id);
            $dato->delete();
            Alert::success('Usuario Eliminado', null);
            return back();

        } catch (\Exception $e) {
            Alert::error('Ha ocurrido un error al eliminar el usuario.', null);
            return back();
        }
    }
}
