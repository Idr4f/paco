<?php

namespace App\Http\Controllers;
use App\Establecimiento;
use App\UserRolEstablecimiento;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EstablecimientosController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function AgregarEstablecimientoForm()
    {

        $tipo_establec = [
            'Bodega' => 'Bodega',
            'Centro comercial' => 'Centro comercial',
            'Edificio comercial' => 'Edificio comercial',
            'Empresa' => 'Empresa',
            'Otros' => 'Otros',
            'Propiedad horizontal' => 'Propiedad horizontal',
            'Propiedad mixta' => 'Propiedad mixta',
            'Propiedad vertical' => 'Propiedad vertical'
        ];

        return view('establecimiento.AgregarEstablecimientoForm')->with(array(
            'tipo_establec' => $tipo_establec         
        ));
    }

    public function AgregarEstablecimientoFormGuardar(Request $request)
    {
        $rules = array(
            'ruta_imagen_establ' => ['required', 'mimes:jpg,jpeg,bmp,png', 'max:8192', 'file'],
            'cod_establec' => ['required', 'max:255', 'unique:establecimientos,cod_establec'],
            'nom_establec' => ['required', 'unique:users,email'],
            'nom_corto_establec' => ['required'],
            'telefono' => ['required', 'min:6'],
            'celular' => ['required', 'min:6'],
            'direccion' => ['required', 'min:6'],
            'correo' => ['required', 'min:6'],
            'tipo_establec' => ['required', 'min:6']          
        );
    
        $messages = [
            'ruta_imagen_establ.mimes' => 'La imagen solo se puede subir en formato JPEG, BMP o PNG.',
            'ruta_imagen_establ.max' => 'El archivo de imagen no debe superar los 8 MB.',
        ];
    
        $this->validate($request, $rules, $messages);
        
        
        $date = date('Y-m-d H:i:s');
        $establ = new Establecimiento($request->all());

        // Subir archivos
        if($request->hasFile('ruta_imagen_establ')){ 
            $file_imagen = $request->file('ruta_imagen_establ');
            $nombre_archivo_imagen = $establ->nom_corto_establec.'.png';
            \Storage::disk('public_storage_establec')->put($nombre_archivo_imagen,  \File::get($file_imagen));
            $establ->ruta_imagen_establ = "https://unidapp-manager.azurewebsites.net/establecimientos/".$nombre_archivo_imagen;
        }

        $establ->estado = "A";
        $establ->creado_e = $date;
        $establ->actualizado_e = $date;
        $establ->save();
    
        return redirect('/')->with(array('message' => 'Se ha agregado el establecimiento  '.$request->nom_establec.' correctamente.')); 
    }

    public function ConsultarEstablecimiento ()
    {
        return view('establecimiento.ConsultarEstablecimiento');
    }

    public function autocompleteestablecimiento(Request $request)
    {
        $search = $request->get('term');
        $result = Establecimiento::where('nom_establec', 'LIKE', '%'. $search. '%')->get();

        return response()->json($result);
    }

    public function DatosEstablecimiento (Request $request)
    {

            $tipo_establec = [
                'Bodega' => 'Bodega',
                'Centro comercial' => 'Centro comercial',
                'Edificio comercial' => 'Edificio comercial',
                'Empresa' => 'Empresa',
                'Otros' => 'Otros',
                'Propiedad horizontal' => 'Propiedad horizontal',
                'Propiedad mixta' => 'Propiedad mixta',
                'Propiedad vertical' => 'Propiedad vertical'
            ];

            $nom_establec = \Request::get('nom_establec');
            $establ = Establecimiento::where('nom_establec', $nom_establec)->get(); 
            $num = Establecimiento::where('nom_establec', $nom_establec)->count();            
            $url = false;
            $admin = null;
            if($num >= 1){
                $establ = $establ[0];
                $url = Storage::disk('public_storage_establec')->exists($establ->ruta_imagen_establ);
                $id_admin_num = UserRolEstablecimiento::where('id_establecimiento', $establ->id)->count();

                if($id_admin_num >= 1){
                    $id_admin = UserRolEstablecimiento::where('id_establecimiento', $establ->id)->get();
                    $id_admin = $id_admin[0]->id_usuario;
                    $admin = User::where('_id', $id_admin)->get();
                    $admin = $admin[0];
                }

            }
        
        return view('establecimiento.DatosEstablecimiento')->with(array(
            'nom_establec' => $nom_establec,
            'establ' => $establ,
            'tipo_establec' => $tipo_establec,
            'num' => $num,
            'url' => $url,
            'admin' => $admin
        ));

    }

    public function ModCodEstabl (Request $request, $id_establ)
    {
        $rules = array(
            'cod_establec' => ['required', 'max:255', Rule::unique('establecimientos','cod_establec')->ignore($id_establ,'_id')],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $establ = Establecimiento::findOrFail($id_establ);
        $establ->fill(\Request::all()); 
        $establ->actualizado_e = $date;
        $establ->update();

        return redirect('/datos-establecimiento?nom_establec='.$establ->nom_establec.'')->with(array('message' => 'El código del establecimiento sido editado correctamente.')); 
    }

    public function ModNom (Request $request, $id_establ)
    {
        $rules = array(
            'nom_establec' => ['required', 'max:255', Rule::unique('establecimientos','nom_establec')->ignore($id_establ,'_id')],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $establ = Establecimiento::findOrFail($id_establ);
        $establ->fill(\Request::all()); 
        $establ->actualizado_e = $date;
        $establ->update();

        return redirect('/datos-establecimiento?nom_establec='.$establ->nom_establec.'')->with(array('message' => 'El nombre del establecimiento sido editado correctamente.')); 
    }

    public function ModNomCorto (Request $request, $id_establ)
    {
        $rules = array(
            'nom_corto_establec' => ['required', 'max:255', Rule::unique('establecimientos','nom_corto_establec')->ignore($id_establ,'_id')],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $establ = Establecimiento::findOrFail($id_establ);
        $establ->fill(\Request::all()); 
        $establ->actualizado_e = $date;
        $establ->update();

        return redirect('/datos-establecimiento?nom_establec='.$establ->nom_establec.'')->with(array('message' => 'El nombre corto del establecimiento sido editado correctamente.')); 
    }

    public function ModNomAdmin (Request $request, $id_establ)
    {
        $rules = array(
            'nom_administrador' => ['required', 'max:255'],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $establ = Establecimiento::findOrFail($id_establ);
        $establ->fill(\Request::all()); 
        $establ->actualizado_e = $date;
        $establ->update();

        return redirect('/datos-establecimiento?nom_establec='.$establ->nom_establec.'')->with(array('message' => 'El nombre del administrador ha sido editado correctamente.')); 
    }

    public function ModTel (Request $request, $id_establ)
    {
        $rules = array(
            'telefono' => ['required', 'max:255'],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $establ = Establecimiento::findOrFail($id_establ);
        $establ->fill(\Request::all()); 
        $establ->actualizado_e = $date;
        $establ->update();

        return redirect('/datos-establecimiento?nom_establec='.$establ->nom_establec.'')->with(array('message' => 'El teléfono ha sido editado correctamente.')); 
    }

    public function ModCel (Request $request, $id_establ)
    {
        $rules = array(
            'celular' => ['required', 'max:255'],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $establ = Establecimiento::findOrFail($id_establ);
        $establ->fill(\Request::all()); 
        $establ->actualizado_e = $date;
        $establ->update();

        return redirect('/datos-establecimiento?nom_establec='.$establ->nom_establec.'')->with(array('message' => 'El celular ha sido editado correctamente.')); 
    }

    public function ModDir (Request $request, $id_establ)
    {
        $rules = array(
            'direccion' => ['required', 'max:255', Rule::unique('establecimientos','direccion')->ignore($id_establ,'_id')],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $establ = Establecimiento::findOrFail($id_establ);
        $establ->fill(\Request::all()); 
        $establ->actualizado_e = $date;
        $establ->update();

        return redirect('/datos-establecimiento?nom_establec='.$establ->nom_establec.'')->with(array('message' => 'La dirección ha sido editado correctamente.')); 
    }

    public function ModCorreo (Request $request, $id_establ)
    {
        $rules = array(
            'correo' => ['required', 'max:255'],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $establ = Establecimiento::findOrFail($id_establ);
        $establ->fill(\Request::all()); 
        $establ->actualizado_e = $date;
        $establ->update();

        return redirect('/datos-establecimiento?nom_establec='.$establ->nom_establec.'')->with(array('message' => 'El correo ha sido editado correctamente.')); 
    }

    public function ModTipEstabl (Request $request, $id_establ)
    {
        $rules = array(
            'tipo_establec' => ['required', 'max:255'],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $establ = Establecimiento::findOrFail($id_establ);
        $establ->fill(\Request::all()); 
        $establ->actualizado_e = $date;
        $establ->update();

        return redirect('/datos-establecimiento?nom_establec='.$establ->nom_establec.'')->with(array('message' => 'El tipo de establecimiento ha sido editado correctamente.')); 
    }

    public function ModEstado (Request $request, $id_establ)
    {
        $rules = array(
            'estado' => ['required', 'max:255'],
          );
    
          $messages = [

          ];
    
          $this->validate($request, $rules, $messages);
        $date = date('Y-m-d H:i:s');
        $establ = Establecimiento::findOrFail($id_establ);
        $establ->fill(\Request::all()); 
        $establ->actualizado_e = $date;
        $establ->update();

        return redirect('/datos-establecimiento?nom_establec='.$establ->nom_establec.'')->with(array('message' => 'El estado del establecimiento ha sido editado correctamente.')); 
    }

    public function EditarEstablecimientoForm (Request $request, $id_establ)
    {
        $tipo_establec = [
            'Bodega' => 'Bodega',
            'Centro comercial' => 'Centro comercial',
            'Edificio comercial' => 'Edificio comercial',
            'Empresa' => 'Empresa',
            'Otros' => 'Otros',
            'Propiedad horizontal' => 'Propiedad horizontal',
            'Propiedad mixta' => 'Propiedad mixta',
            'Propiedad vertical' => 'Propiedad vertical'
        ];

        $establ = Establecimiento::findOrFail($id_establ);

        // $url = Storage::disk('local')->exists('/establecimientos/'.$establ->ruta_imagen_establ);
        // $url = Storage::disk('public_storage_establec')->exists($establ->ruta_imagen_establ);

        return view('establecimiento.EditarEstablecimiento')->with(array(
            'establ' => $establ,
            'tipo_establec' => $tipo_establec
        ));

    }

    public function EditarEstablecimientoFormGuardar (Request $request, $id_establ)
    {
        $rules = array(
            'ruta_imagen_establ' => ['mimes:jpg,jpeg,bmp,png', 'max:8192', 'file'],
            'cod_establec' => ['required', 'max:255', Rule::unique('establecimientos','cod_establec')->ignore($id_establ,'_id')],
            'nom_establec' => ['required', 'unique:users,email'],
            'nom_corto_establec' => ['required'],
            'telefono' => ['required', 'min:6'],
            'celular' => ['required', 'min:6'],
            'direccion' => ['required', 'min:6'],
            'correo' => ['required', 'min:6'],
            'tipo_establec' => ['required', 'min:6']    
        );
    
        $messages = [

        ];
    
        $this->validate($request, $rules, $messages);

        $date = date('Y-m-d H:i:s');
        $establ = Establecimiento::findOrFail($id_establ);

        // Subir archivos
        if($request->hasFile('ruta_imagen_establ')){ 
            $file_imagen = $request->file('ruta_imagen_establ');
            $nombre_archivo_imagen = $establ->nom_corto_establec.'.png';
            \Storage::disk('public_storage_establec')->put($nombre_archivo_imagen,  \File::get($file_imagen));
            $establ->ruta_imagen_establ = "https://unidapp-manager.azurewebsites.net/establecimientos/".$nombre_archivo_imagen;
        }

        $establ->fill(\Request::all()); 
        $establ->actualizado_e = $date;
        $establ->update();

        return redirect('/')->with(array('message' => 'El establecimiento '.$request->nom_establec.' ha sido editado correctamente.')); 
    }

    public function ConsultarEstablecimientos (Request $request) {
        
        $establecimientos = Establecimiento::orderBy('nom_establec', 'ASC')->paginate(20);
        
        $i = 0;
        return view('establecimiento.ConsultarEstablecimientos')->with(array(
            'establecimientos' => $establecimientos,
            'i' => $i
        ));
    }

    public static function ConsultarNomEstablec ($id_establec){        
        $id_establec = Establecimiento::where('_id', $id_establec)->get();
        $id_establec = $id_establec[0]->nom_establec;

        return $id_establec;
    }
}
