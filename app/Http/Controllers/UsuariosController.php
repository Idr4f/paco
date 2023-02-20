<?php

namespace App\Http\Controllers;
use App\User;
use App\Rol;
use App\UserRolEstablecimiento;
use App\Establecimiento;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use DB;

class UsuariosController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function AgregarUsuarioForm()
    {
        return view('usuario.AgregarUsuarioForm');
    }

    public function AgregarUsuarioFormGuardar(Request $request)
    {
        $rules = array(
            'email' => ['required', 'unique:users,email'],
            'nombre' => ['required'],
            'password' => ['required', 'min:6']
          );

          $messages = [

          ];

          $this->validate($request, $rules, $messages);


        $date = date('Y-m-d H:i:s');
        $usuario = new User($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->estado = "A";
        $usuario->created_at = $date;
        $usuario->updated_at = $date;
        $usuario->save();

        return redirect('/')->with(array('message' => 'Se ha agregado el usuario  '.$request->usuario.' correctamente.'));
    }

    public function ConsultarUsuarios (Request $request) {

        $usuarios = User::orderBy('nombre', 'ASC')->paginate(20);

        $i = 0;
        return view('usuario.ConsultarUsuarios')->with(array(
            'usuarios' => $usuarios,
            '_id' => $i
        ));
    }

    public static function ConsultarRolAdmin ($id_usuario){

        $id_usuario = UserRolEstablecimiento::where('id_usuario', $id_usuario)->get();
        $id_usuario = $id_usuario[0]->id_rol;
        return $id_usuario;

        // return $id_usuario;
    }

    public static function ConsultarRol ($id_usuario){

        $count = UserRolEstablecimiento::where('id_usuario', $id_usuario)->count();

        if($count > 0){
            $id_usuario = UserRolEstablecimiento::where('id_usuario', $id_usuario)->get();
            $id_usuario = $id_usuario[0]->id_rol;
            return $id_usuario;
        }else{
            $id_usuario = 0;
            return $id_usuario;
        }

    }

    public static function ConsultarNomRol ($id_rol){
        $id_rol = Rol::where('_id', $id_rol)->get();
        $id_rol = $id_rol[0]->nom_rol;

        return $id_rol;
    }

    public static function ConsultarNomEstablec ($id_establec){
        $id_establec = Establecimiento::where('_id', $id_establec)->get();
        $id_establec = $id_establec[0]->nom_establec;

        return $id_establec;
    }

    public function EditarUsuarioForm (Request $request, $id_usuario)
    {

        $usuario = User::findOrFail($id_usuario);

        return view('usuario.EditarUsuario')->with(array(
            'usuario' => $usuario
        ));

    }

    public function EditarUsuarioFormGuardar (Request $request, $id_usuario)
    {
        $rules = array(
            'nombre' => ['required', 'max:255', Rule::unique('users','nombre')->ignore($id_usuario,'_id')],
            'email' => ['required', 'max:255', Rule::unique('users','email')->ignore($id_usuario,'_id')],
          );

          $messages = [

          ];

          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $usuario = User::findOrFail($id_usuario);
        $usuario->fill(\Request::all());
        $usuario->updated_at = $date;
        $usuario->update();

        return redirect('/')->with(array('message' => 'El usuario '.$request->nombre.' ha sido editado correctamente.'));
    }

    public function ConsultarUsuario ()
    {
        return view('usuario.ConsultarUsuario');
    }

    public function autocompleteusuario(Request $request){
        $search = $request->get('term');

        $result = User::where('email', 'LIKE', '%'. $search. '%')->get();

        return response()->json($result);
    }

    public function DatosUsuario (Request $request)
    {

            $email = \Request::get('email');
            $usuario = User::where('email', $email)->get();
            $num = User::where('email', $email)->count();

            if($num >= 1){
                $usuario = $usuario[0];
            }

        return view('usuario.DatosUsuario')->with(array(
            'email' => $email,
            'usuario' => $usuario,
            'num' => $num
        ));

    }

    public function ModNombre (Request $request, $id_usuario)
    {
        $rules = array(
            'nombre' => ['required', 'max:255', Rule::unique('users','nombre')->ignore($id_usuario,'_id')],
          );

          $messages = [

          ];

          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $usuario = User::findOrFail($id_usuario);
        $usuario->fill(\Request::all());
        $usuario->updated_at = $date;
        $usuario->update();

        return redirect('/datos-usuario?email='.$usuario->email.'')->with(array('message' => 'El nombre del usuario ha sido editado correctamente.'));
    }

    public function ModCorreo (Request $request, $id_usuario)
    {
        $rules = array(
            'email' => ['required', 'max:255', Rule::unique('users','email')->ignore($id_usuario,'_id')],
          );

          $messages = [

          ];

          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $usuario = User::findOrFail($id_usuario);
        $usuario->fill(\Request::all());
        $usuario->updated_at = $date;
        $usuario->update();

        return redirect('/datos-usuario?email='.$usuario->email.'')->with(array('message' => 'El correo del usuario ha sido editado correctamente.'));
    }

    public function ModEstado (Request $request, $id_usuario)
    {
        $rules = array(

          );

          $messages = [

          ];

          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $usuario = User::findOrFail($id_usuario);
        $usuario->fill(\Request::all());
        $usuario->updated_at = $date;
        $usuario->update();

        return redirect('/datos-usuario?email='.$usuario->email.'')->with(array('message' => 'El estado del usuario ha sido editado correctamente.'));
    }

    public function ConsultarEstablecimientoUsuario (Request $request)
    {

        return view('usuario.EstablecimientoUsuario');

    }

    public function DatosEstablecimiento (Request $request)
    {

            $email = \Request::get('email');
            $usuario = User::where('email', $email)->get();
            $num = User::where('email', $email)->count();
            $UserRolEstablec = null;
            $select_roles = null;
            $select_establec = null;


            if($num >= 1){
                $usuario = $usuario[0];
                $UserRolEstablecimientos = UserRolEstablecimiento::where('id_usuario', $usuario->_id)->paginate(20);

                $opciones_roles = Rol::orderBy('nom_rol', 'ASC')->get();
                $num_roles = Rol::orderBy('nom_rol', 'ASC')->count();

                for($i = 0; $i < $num_roles; $i++){
                    $select_roles[$opciones_roles[$i]->id] = $opciones_roles[$i]->nom_rol;
                }


                $opciones_establec = Establecimiento::orderBy('nom_establec', 'ASC')->get();
                $num_establec = Establecimiento::orderBy('nom_establec', 'ASC')->count();

                for($i = 0; $i < $num_establec; $i++){
                    $select_establec[$opciones_establec[$i]->id] = $opciones_establec[$i]->nom_establec;
                }
            }else{
                $UserRolEstablecimientos = null;
            }

        $i = 0;
        return view('usuario.DatosEstablecimiento')->with(array(
            'email' => $email,
            'usuario' => $usuario,
            'UserRolEstablecimientos' => $UserRolEstablecimientos,
            'select_roles' => $select_roles,
            'select_establec' => $select_establec,
            'num' => $num,
            'i' => $i
        ));

    }

    public function ModRol (Request $request, $id_usuario, $email)
    {
        $rules = array(

          );

          $messages = [

          ];

        $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $userRolEstablec = UserRolEstablecimiento::findOrFail($id_usuario);
        $userRolEstablec->fill(\Request::all());
        $userRolEstablec->actualizado_e = $date;
        $userRolEstablec->update();

        return redirect('/establecimiento-usuario?email='.$email.'')->with(array('message' => 'Se ha modificado el rol del usuario correctamente.'));
    }

    public function ModEstablecimiento (Request $request, $id_usuario, $email)
    {
        $rules = array(

          );

          $messages = [

          ];

        $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');

        $userRolEstablec = UserRolEstablecimiento::findOrFail($id_usuario);
        $userRolEstablec->fill(\Request::all());
        $userRolEstablec->actualizado_e = $date;
        $userRolEstablec->update();

        return redirect('/establecimiento-usuario?email='.$email.'')->with(array('message' => 'Se ha modificado el establecimiento del usuario correctamente.'));
    }

    public function AgregarRolEstablec (Request $request, $id_usuario, $email)
    {

        $rules = array(
            'id_establecimiento' => [Rule::unique('usuario_rol_establecimiento')->where('id_usuario', $id_usuario)]

        );

        $messages = [
            'id_establecimiento.unique' => 'El establecimiento seleccionado ya ha sido asignado a un usuario.',
        ];

        $this->validate($request, $rules, $messages);


        $date = date('Y-m-d H:i:s');
        $userRolEstablec = new UserRolEstablecimiento($request->all());
        $userRolEstablec->id_usuario = $id_usuario;
        $userRolEstablec->creado_e = $date;
        $userRolEstablec->actualizado_e = $date;
        $userRolEstablec->save();

        return redirect('/establecimiento-usuario?email='.$email.'')->with(array('message' => 'Se ha agregado la asignación del establecimiento del usuario correctamente.'));
    }

    public function ModRolEstablec (Request $request, $id_rol_establec, $email)
    {
        $rules = array(

        );

        $messages = [

        ];

      $this->validate($request, $rules, $messages);
      $date = date('Y-m-d H:i:s');
      $userRolEstablec = UserRolEstablecimiento::findOrFail($id_rol_establec);
      $userRolEstablec->fill(\Request::all());
      $userRolEstablec->actualizado_e = $date;
      $userRolEstablec->update();

      return redirect('/establecimiento-usuario?email='.$email.'')->with(array('message' => 'Se ha modificado la asignación del establecimiento del usuario correctamente.'));
    }

    public function EliminarRolEstablec (Request $request, $id_rol_establec, $email)
    {
        $userRolEstablec = UserRolEstablecimiento::findOrFail($id_rol_establec);
        $userRolEstablec->delete();

        return redirect('/establecimiento-usuario?email='.$email.'')->with(array('message' => 'Se ha eliminado la asignación del establecimiento del usuario correctamente.'));
    }

}
