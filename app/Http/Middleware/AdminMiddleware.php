<?php

namespace App\Http\Middleware;
use App\Http\Controllers\UsuariosController;
use Auth;
use App\Rol;

use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle( $request, Closure $next)
    {
       /*   $id_rol = Rol::where('nom_rol', 'Admin')->get();
         $id_rol = $id_rol[0]->_id;

        $id_rol_user = UsuariosController::ConsultarRolAdmin(auth()->user()->_id);

         if (auth()->check() && $id_rol_user == $id_rol && auth()->user()->estado == 'A')
         return $next($request);

         Auth::logout();
         return redirect('/login')->with(array('status' => 'El usuario no tiene permiso para ingresar.')); */
    }
}
