<?php

namespace App\Http\Controllers;
use App\Rol;
use App\RolOpcion;
use App\Opcion;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function AgregarRolForm()
    {

        return view('rol.AgregarRolForm');
    }

    public function AgregarRolFormGuardar(Request $request)
    {
        $rules = array(
            'nom_rol' => ['required', 'unique:roles,nom_rol'],
            'desc_rol' => ['required']
          );

          $messages = [
            'nom_rol.unique' => 'Ya existe un rol con el nombre ingresado',
            'nom_rol.required' => 'Por favor ingresa el nombre del rol',
            'desc_rol.required' => 'Por favor ingresa una descripción del rol'
          ];

          $this->validate($request, $rules, $messages);


        $date = date('Y-m-d H:i:s');
        $establ = new Rol($request->all());
        $establ->estado = "A";
        $establ->creado_e = $date;
        $establ->actualizado_e = $date;
        $establ->save();

        return redirect('/')->with(array('message' => 'Se ha agregado el rol  '.$request->nom_rol.' correctamente.'));
    }

    public function ConsultarRol ()
    {
        return view('rol.ConsultarRol');
    }

    public function autocompleterol(Request $request)
    {
        $search = $request->get('term');

        $result = Rol::where('nom_rol', 'LIKE', '%'. $search. '%')->get();

        return response()->json($result);
    }

    public function DatosRol (Request $request)
    {

        $nom_rol = \Request::get('nom_rol');
        $rol = Rol::where('nom_rol', $nom_rol)->get();
        $num = Rol::where('nom_rol', $nom_rol)->count();

        if($num >= 1){
            $rol = $rol[0];
        }

        return view('rol.DatosRol')->with(array(
            'nom_rol' => $nom_rol,
            'rol' => $rol,
            'num' => $num
        ));

    }

    public function ModNombre (Request $request, $id_rol)
    {
        $rules = array(
            'nom_rol' => ['required', 'max:255', Rule::unique('roles','nom_rol')->ignore($id_rol,'_id')],
          );

          $messages = [

          ];

          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $rol = Rol::findOrFail($id_rol);
        $rol->fill(\Request::all());
        $rol->actualizado_e = $date;
        $rol->update();

        return redirect('/datos-rol?nom_rol='.$rol->nom_rol.'')->with(array('message' => 'El nombre del rol ha sido editado correctamente.'));
    }

    public function ModDesc (Request $request, $id_rol)
    {
        $rules = array(
            'desc_rol' => ['required', 'max:255'],
          );

          $messages = [

          ];

          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $rol = Rol::findOrFail($id_rol);
        $rol->fill(\Request::all());
        $rol->actualizado_e = $date;
        $rol->update();

        return redirect('/datos-rol?nom_rol='.$rol->nom_rol.'')->with(array('message' => 'La descripción del rol ha sido editado correctamente.'));
    }

    public function ModEstado (Request $request, $id_rol)
    {
        $rules = array(

          );

          $messages = [

          ];

          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $rol = Rol::findOrFail($id_rol);
        $rol->fill(\Request::all());
        $rol->actualizado_e = $date;
        $rol->update();

        return redirect('/datos-rol?nom_rol='.$rol->nom_rol.'')->with(array('message' => 'El estado del rol ha sido editado correctamente.'));
    }

    public function EditarRolForm (Request $request, $id_rol)
    {

        $rol = Rol::findOrFail($id_rol);

        return view('rol.EditarRol')->with(array(
            'rol' => $rol
        ));

    }

    public function EditarRolFormGuardar (Request $request, $id_rol)
    {
        $rules = array(
            'nom_rol' => ['required', 'max:255', Rule::unique('roles','nom_rol')->ignore($id_rol,'_id')],
            'desc_rol' => ['required', 'max:255'],
          );

          $messages = [

          ];

          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $rol = Rol::findOrFail($id_rol);
        $rol->fill(\Request::all());
        $rol->actualizado_e = $date;
        $rol->update();

        return redirect('/')->with(array('message' => 'El rol '.$request->nom_rol.' ha sido editado correctamente.'));
    }

    public function ConsultarRoles (Request $request)
    {

        $roles = Rol::orderBy('nom_rol', 'ASC')->paginate(20);

        $i = 0;
        return view('rol.ConsultarRoles')->with(array(
            'roles' => $roles,
            'i' => $i
        ));
    }

    public function ConsultarRolOpciones (){
        return view('rol.ConsultarRolOpciones');
    }

    public function OpcionesRol (){
        $nom_rol = \Request::get('nom_rol');
        $rol = Rol::where('nom_rol', $nom_rol)->get();
        $num = Rol::where('nom_rol', $nom_rol)->count();
        $opciones = null;
        $select = null;

        if($num >= 1){
            $rol = $rol[0];
            $opciones = RolOpcion::where('id_rol', $rol->_id)->paginate(20);
            $opciones_select = Opcion::orderBy('nom_opcion', 'ASC')->get();
            $num = Opcion::orderBy('nom_opcion', 'ASC')->count();

            for($i = 0; $i < $num; $i++){
                $select[$opciones_select[$i]->id] = $opciones_select[$i]->nom_opcion;
            }


        }
        $i = 0;
        return view('rol.OpcionesRol')->with(array(
            'nom_rol' => $nom_rol,
            'rol' => $rol,
            'opciones' => $opciones,
            'num' => $num,
            'i' => $i,
            'select' => $select
        ));
    }

    public static function ConsultarNomOpcion ($id_opcion){
        $id_opcion = Opcion::where('_id', $id_opcion)->get();
        $id_opcion = $id_opcion[0]->nom_opcion;

        return $id_opcion;
    }

    public static function ConsultarNomRol ($id_rol){
        $id_rol = Rol::where('_id', $id_rol)->get();
        $id_rol = $id_rol[0]->nom_rol;

        return $id_rol;
    }

    public function ModConfigRolOpcion (Request $request, $id_opcion, $nom_rol)
    {
        $rules = array(

        );

        $messages = [

        ];

        $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $rol = RolOpcion::findOrFail($id_opcion);
        $rol->fill(\Request::all());
        $rol->actualizado_e = $date;
        $rol->update();

        return redirect('/opciones-rol?nom_rol='.$nom_rol.'')->with(array('message' => 'Las configuraciones han sido editadas correctamente.'));
    }

    public function AgregarOpcRol(Request $request, $id_rol, $nom_rol)
    {
        $rules = array(
            'id_opcion' => [Rule::unique('rol_opciones', 'id_opcion')->where('id_rol', $id_rol)]
        );

        $messages = [
            'id_opcion.unique' => 'La opción seleccionada ya se encuentra en el rol '.$request->nom_rol.'',
        ];

        $this->validate($request, $rules, $messages);


        $date = date('Y-m-d H:i:s');
        $rolOpc = new RolOpcion($request->all());
        $rolOpc->id_rol = $id_rol;
        $rolOpc->creacion = "S";
        $rolOpc->lectura = "S";
        $rolOpc->modificacion = "S";
        $rolOpc->eliminacion = "S";
        $rolOpc->estado = "A";
        $rolOpc->creado_e = $date;
        $rolOpc->actualizado_e = $date;
        $rolOpc->save();

        return redirect('/opciones-rol?nom_rol='.$nom_rol.'')->with(array('message' => 'Se ha agregado la opción seleccionada al rol '.$request->nom_rol.' correctamente.'));
    }

    public function EliminarOpcRol(Request $request, $id_rolopc, $nom_rol)
    {
        $rolOpc = RolOpcion::findOrFail($id_rolopc);
        $rolOpc->delete();

        return redirect('/opciones-rol?nom_rol='.$nom_rol.'')->with(array('message' => 'Se ha eliminado la opción seleccionada al rol '.$request->nom_rol.' correctamente.'));
    }
}
