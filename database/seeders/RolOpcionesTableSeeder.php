<?php

use Illuminate\Database\Seeder;
use App\RolOpcion;
use App\Rol;
use App\Opcion;

class RolOpcionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');

        $id_rol = Rol::where('nom_rol', 'Administrador')->get();
        $id_rol = $id_rol[0]->_id;

        $id_opcion1 = Opcion::where('nom_opcion', 'Crear usuarios')->get();
        $id_opcion1 = $id_opcion1[0]->_id;

        $id_opcion2 = Opcion::where('nom_opcion', 'Consultar usuarios')->get();
        $id_opcion2 = $id_opcion2[0]->_id;

        $rol_opcion = new RolOpcion(); 
        $rol_opcion->id_rol = $id_rol;    
        $rol_opcion->id_opcion = $id_opcion1;
        $rol_opcion->creacion = 'S';
        $rol_opcion->lectura = 'S';
        $rol_opcion->modificacion = 'S';
        $rol_opcion->eliminacion = 'S';
        $rol_opcion->estado = 'A';
        $rol_opcion->creado_e = $date;
        $rol_opcion->actualizado_e = $date;
        $rol_opcion->save();

        $rol_opcion = new RolOpcion(); 
        $rol_opcion->id_rol = $id_rol;    
        $rol_opcion->id_opcion = $id_opcion2;
        $rol_opcion->creacion = 'N';
        $rol_opcion->lectura = 'S';
        $rol_opcion->modificacion = 'N';
        $rol_opcion->eliminacion = 'N';
        $rol_opcion->estado = 'A';
        $rol_opcion->creado_e = $date;
        $rol_opcion->actualizado_e = $date;
        $rol_opcion->save();
    }
}
