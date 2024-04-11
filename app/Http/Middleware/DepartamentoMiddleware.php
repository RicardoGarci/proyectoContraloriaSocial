<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class DepartamentoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $departamento)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {
            // Obtener el usuario autenticado
            $usuario = Auth::user();

            // Verificar si el usuario pertenece al departamento especificado
            if ($usuario->departamento == $departamento or ($usuario->rol == 'super'or $usuario->rol == 'director')) {
                return $next($request);
            }
        }
        // Si el usuario no pertenece al departamento
        Alert::error('Acceso restringido.', 'No tienes permiso para acceder a este modulo');
        return back();
        //return redirect()->route('pagina.de.error')->with('error', 'No tienes permiso para acceder a esta página.');
    }
}
