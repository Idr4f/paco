<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');

        $rol = new Rol(); 
        $rol->nom_rol = 'Admin';    
        $rol->desc_rol = 'Rol de administrador del sistema';
        $rol->estado = 'A';
        $rol->creado_e = $date;
        $rol->actualizado_e = $date;
        $rol->save();

        $rol = new Rol(); 
        $rol->nom_rol = 'Administrador';    
        $rol->desc_rol = 'Rol de administrador de las propiedades';
        $rol->estado = 'A';
        $rol->creado_e = $date;
        $rol->actualizado_e = $date;
        $rol->save();
    }
}
