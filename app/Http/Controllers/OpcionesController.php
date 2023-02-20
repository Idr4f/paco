<?php

namespace App\Http\Controllers;
use App\Opcion;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OpcionesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function AgregarOpcionForm()
    {

        return view('opcion.AgregarOpcionForm');
    }

    public function AgregarOpcionFormGuardar(Request $request)
    {
        $rules = array(
            'nom_opcion' => ['required', 'unique:opciones,nom_opcion'],
            'desc_opcion' => ['required'],
          );
    
          $messages = [
            'nom_opcion.unique' => 'Ya existe una opción con el nombre ingresado',
            'nom_opcion.required' => 'Por favor ingresa el nombre de la opción',
            'desc_opcion.required' => 'Por favor ingresa una descripción de la opción'
          ];
    
          $this->validate($request, $rules, $messages);
        
        
        $date = date('Y-m-d H:i:s');
        $opc = new Opcion($request->all());
        $opc->estado = "A";
        $opc->creado_e = $date;
        $opc->actualizado_e = $date;
        $opc->save();
    
        return redirect('/')->with(array('message' => 'Se ha agregado la opción  '.$request->nom_opcion.' correctamente.')); 
    }

    public function ConsultarOpcion ()
    {
        return view('opcion.ConsultarOpcion');
    }

    public function autocompleteopcion(Request $request)
    {
        $search = $request->get('term');
      
        $result = Opcion::where('nom_opcion', 'LIKE', '%'. $search. '%')->get();

        return response()->json($result);
    }

    public function DatosOpcion (Request $request)
    {

            $nom_opcion = \Request::get('nom_opcion');
            $opc = Opcion::where('nom_opcion', $nom_opcion)->get(); 
            $num = Opcion::where('nom_opcion', $nom_opcion)->count();     

            if($num >= 1){
                $opc = $opc[0];
            }
        
        return view('opcion.DatosOpcion')->with(array(
            'nom_opcion' => $nom_opcion,
            'opc' => $opc,
            'num' => $num
        ));

    }

    public function EditarOpcionForm (Request $request, $id_opcion)
    {

        $opc = Opcion::findOrFail($id_opcion);

        return view('opcion.EditarOpcion')->with(array(
            'opc' => $opc         
        ));

    }

    public function ModNombre (Request $request, $id_opcion)
    {
        $rules = array(
            'nom_opcion' => ['required', 'max:255', Rule::unique('opciones','nom_opcion')->ignore($id_opcion,'_id')],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $opc = Opcion::findOrFail($id_opcion);
        $opc->fill(\Request::all()); 
        $opc->actualizado_e = $date;
        $opc->update();

        return redirect('/datos-opcion?nom_opcion='.$opc->nom_opcion.'')->with(array('message' => 'El nombre de la opción ha sido editada correctamente.')); 
    }

    public function ModDesc (Request $request, $id_opcion)
    {
        $rules = array(
            'desc_opcion' => ['required', 'max:255'],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $opc = Opcion::findOrFail($id_opcion);
        $opc->fill(\Request::all()); 
        $opc->actualizado_e = $date;
        $opc->update();

        return redirect('/datos-opcion?nom_opcion='.$opc->nom_opcion.'')->with(array('message' => 'La descripción de la opción ha sido editada correctamente.')); 
    }

    public function ModAppEstabl (Request $request, $id_opcion)
    {
        $rules = array(
            'app_establec' => ['required'],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $opc = Opcion::findOrFail($id_opcion);
        $opc->fill(\Request::all()); 
        $opc->actualizado_e = $date;
        $opc->update();

        return redirect('/datos-opcion?nom_opcion='.$opc->nom_opcion.'')->with(array('message' => 'La opción ha sido editada correctamente.')); 
    }

    public function ModAppMiemb (Request $request, $id_opcion)
    {
        $rules = array(
            'app_miembro' => ['required'],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $opc = Opcion::findOrFail($id_opcion);
        $opc->fill(\Request::all()); 
        $opc->actualizado_e = $date;
        $opc->update();

        return redirect('/datos-opcion?nom_opcion='.$opc->nom_opcion.'')->with(array('message' => 'La opción ha sido editada correctamente.')); 
    }

    public function ModEstado (Request $request, $id_opcion)
    {
        $rules = array(
            'estado' => ['required'],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $opc = Opcion::findOrFail($id_opcion);
        $opc->fill(\Request::all()); 
        $opc->actualizado_e = $date;
        $opc->update();

        return redirect('/datos-opcion?nom_opcion='.$opc->nom_opcion.'')->with(array('message' => 'El estado de la opción ha sido editado correctamente.')); 
    }

    public function EditarOpcionFormGuardar (Request $request, $id_opcion)
    {
        $rules = array(
            'nom_opcion' => ['required', Rule::unique('opciones','nom_opcion')->ignore($id_opcion,'_id')],
            'desc_opcion' => ['required', 'max:255'],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $opc = Opcion::findOrFail($id_opcion);
        $opc->fill(\Request::all()); 
        $opc->actualizado_e = $date;
        $opc->update();

        return redirect('/')->with(array('message' => 'La opción '.$request->nom_opcion.' ha sido editado correctamente.')); 
    }

    public function ConsultarOpciones (Request $request)
    {
        
        $opciones = Opcion::orderBy('nom_opcion', 'ASC')->paginate(20);
        
        $i = 0;
        return view('opcion.ConsultarOpciones')->with(array(
            'opciones' => $opciones,
            'i' => $i
        ));
    }
}
