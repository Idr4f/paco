<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Rol;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');

        $id_rol_admin = Rol::where('nom_rol', 'Admin')->get();
        $id_rol_admin = $id_rol_admin[0]->_id;

        $id_rol_administrador = Rol::where('nom_rol', 'Administrador')->get();
        $id_rol_administrador = $id_rol_administrador[0]->_id;

        $user = new User();
        $user->email = 'dgarzon@unidapp.com';
        $user->nombre = 'Danny Stewart Garzón Rico';
        $user->password = bcrypt('qwe123**');
        $user->estado = 'A';
        $user->id_rol = $id_rol_admin;
        $user->updated_at = $date;
        $user->created_at = $date;
        $user->save();

        $user = new User();
        $user->email = 'jmira@unidapp.com';
        $user->nombre = 'Juan Camilo Mira Cardona';
        $user->password = bcrypt('qwe123**');
        $user->estado = 'A';
        $user->id_rol = $id_rol_admin;
        $user->updated_at = $date;
        $user->created_at = $date;
        $user->save();

        $user = new User();
        $user->email = 'dcastrillon@unidapp.com';
        $user->nombre = 'Daniel Castrillon';
        $user->password = bcrypt('qwe123**');
        $user->estado = 'A';
        $user->id_rol = $id_rol_admin;
        $user->updated_at = $date;
        $user->created_at = $date;
        $user->save();

        $user = new User();
        $user->email = 'jaguilar@unidapp.com';
        $user->nombre = 'Juan Camilo Aguilar';
        $user->password = bcrypt('qwe123**');
        $user->estado = 'A';
        $user->id_rol = $id_rol_admin;
        $user->updated_at = $date;
        $user->created_at = $date;
        $user->save();

        $user = new User();
        $user->email = 'administrador1@torre1.com';
        $user->nombre = 'Administrador Unidad';
        $user->password = bcrypt('qwe123**');
        $user->estado = 'A';
        $user->id_rol = $id_rol_administrador;
        $user->updated_at = $date;
        $user->created_at = $date;
        $user->save();

        $user = new User();
        $user->email = 'administrador2@torre2.com';
        $user->nombre = 'Administrador Unidad 2';
        $user->password = bcrypt('qwe123**');
        $user->estado = 'A';
        $user->id_rol = $id_rol_administrador;
        $user->updated_at = $date;
        $user->created_at = $date;
        $user->save();
    }
}
