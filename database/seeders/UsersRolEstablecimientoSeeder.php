<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Rol;
use App\Establecimiento;
use App\UserRolEstablecimiento;

class UsersRolEstablecimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');

        $id_usuario_dgarzon = User::where('email', 'dgarzon@unidapp.com')->get();
        $id_usuario_dgarzon = $id_usuario_dgarzon[0]->_id;

        $id_usuario_jmira = User::where('email', 'jmira@unidapp.com')->get();
        $id_usuario_jmira = $id_usuario_jmira[0]->_id;

        $id_usuario_dcastrillon = User::where('email', 'dcastrillon@unidapp.com')->get();
        $id_usuario_dcastrillon = $id_usuario_dcastrillon[0]->_id;

        $id_usuario_jaguilar = User::where('email', 'jaguilar@unidapp.com')->get();
        $id_usuario_jaguilar = $id_usuario_jaguilar[0]->_id;

        $id_usuario_administrador1 = User::where('email', 'administrador1@torre1.com')->get();
        $id_usuario_administrador1 = $id_usuario_administrador1[0]->_id;

        $id_usuario_administrador2 = User::where('email', 'administrador2@torre2.com')->get();
        $id_usuario_administrador2 = $id_usuario_administrador2[0]->_id;

        $id_rol_admin = Rol::where('nom_rol', 'Admin')->get();
        $id_rol_admin = $id_rol_admin[0]->_id;

        $id_rol_administrador = Rol::where('nom_rol', 'Administrador')->get();
        $id_rol_administrador = $id_rol_administrador[0]->_id;

        $id_establecimiento1 = Establecimiento::where('nom_establec', 'Establecimiento 1')->get();
        $id_establecimiento1 = $id_establecimiento1[0]->_id;

        $id_establecimiento2 = Establecimiento::where('nom_establec', 'Establecimiento 2')->get();
        $id_establecimiento2 = $id_establecimiento2[0]->_id;

        $id_establecimientoU = Establecimiento::where('nom_establec', 'UnidApp')->get();
        $id_establecimientoU = $id_establecimientoU[0]->_id;

        // Usuario 1
        $userRolEstablec = new UserRolEstablecimiento();
        $userRolEstablec->id_usuario = $id_usuario_dgarzon;
        $userRolEstablec->id_rol = $id_rol_admin;
        $userRolEstablec->id_establecimiento = $id_establecimientoU;
        $userRolEstablec->creado_e = $date;
        $userRolEstablec->actualizado_e = $date;
        $userRolEstablec->save();

        // Usuario 2
        $userRolEstablec = new UserRolEstablecimiento();
        $userRolEstablec->id_usuario = $id_usuario_jmira;
        $userRolEstablec->id_rol = $id_rol_admin;
        $userRolEstablec->id_establecimiento = $id_establecimientoU;
        $userRolEstablec->creado_e = $date;
        $userRolEstablec->actualizado_e = $date;
        $userRolEstablec->save();

        // Usuario 3
        $userRolEstablec = new UserRolEstablecimiento();
        $userRolEstablec->id_usuario = $id_usuario_dcastrillon;
        $userRolEstablec->id_rol = $id_rol_admin;
        $userRolEstablec->id_establecimiento = $id_establecimientoU;
        $userRolEstablec->creado_e = $date;
        $userRolEstablec->actualizado_e = $date;
        $userRolEstablec->save();

        // Usuario 4
        $userRolEstablec = new UserRolEstablecimiento();
        $userRolEstablec->id_usuario = $id_usuario_jaguilar;
        $userRolEstablec->id_rol = $id_rol_admin;
        $userRolEstablec->id_establecimiento = $id_establecimientoU;
        $userRolEstablec->creado_e = $date;
        $userRolEstablec->actualizado_e = $date;
        $userRolEstablec->save();

        // Usuario 5
        $userRolEstablec = new UserRolEstablecimiento();
        $userRolEstablec->id_usuario = $id_usuario_administrador1;
        $userRolEstablec->id_rol = $id_rol_administrador;
        $userRolEstablec->id_establecimiento = $id_establecimiento1;
        $userRolEstablec->creado_e = $date;
        $userRolEstablec->actualizado_e = $date;
        $userRolEstablec->save();

        // Usuario 6
        $userRolEstablec = new UserRolEstablecimiento();
        $userRolEstablec->id_usuario = $id_usuario_administrador2;
        $userRolEstablec->id_rol = $id_rol_administrador;
        $userRolEstablec->id_establecimiento = $id_establecimiento2;
        $userRolEstablec->creado_e = $date;
        $userRolEstablec->actualizado_e = $date;
        $userRolEstablec->save();
    }
}
