<?php

use Illuminate\Database\Seeder;
use App\Opcion;

class OpcionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = date('Y-m-d H:i:s');

        $opcion = new Opcion(); 
        $opcion->nom_opcion = 'Crear usuarios';    
        $opcion->desc_opcion = 'Permite al usuario crear usuarios';
        $opcion->app_establec = 'S';
        $opcion->app_miembro = 'S';
        $opcion->estado = 'A';
        $opcion->creado_e = $date;
        $opcion->actualizado_e = $date;
        $opcion->save();

        $opcion = new Opcion(); 
        $opcion->nom_opcion = 'Consultar usuarios';    
        $opcion->desc_opcion = 'Permite al usuario consultar usuarios';
        $opcion->app_establec = 'S';
        $opcion->app_miembro = 'S';
        $opcion->estado = 'A';
        $opcion->creado_e = $date;
        $opcion->actualizado_e = $date;
        $opcion->save();

    }
}
