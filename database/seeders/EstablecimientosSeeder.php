<?php

use Illuminate\Database\Seeder;
use App\Establecimiento;

class EstablecimientosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $date = date('Y-m-d H:i:s');

        $establ = new Establecimiento();
        $establ->ruta_imagen_establ = '';
        $establ->cod_establec = '000';
        $establ->nom_establec = 'UnidApp';
        $establ->nom_corto_establec = 'unidapp';
        $establ->telefono = '0000000';
        $establ->celular = '3000000000';
        $establ->direccion = 'Calle 30';
        $establ->correo = 'unidapp@unidapp.com';
        $establ->tipo_establec = 'Propiedad mixta';
        $establ->estado = 'A';
        $establ->creado_e = $date;
        $establ->actualizado_e = $date;
        $establ->save();

        $establ = new Establecimiento();
        $establ->ruta_imagen_establ = '';
        $establ->cod_establec = '123';
        $establ->nom_establec = 'Establecimiento 1';
        $establ->nom_corto_establec = 'EST1';
        $establ->telefono = '1111111';
        $establ->celular = '3111111111';
        $establ->direccion = 'Calle 40';
        $establ->correo = 'establ1@establ1.com';
        $establ->tipo_establec = 'Propiedad horizontal';
        $establ->estado = 'A';
        $establ->creado_e = $date;
        $establ->actualizado_e = $date;
        $establ->save();

        $establ = new Establecimiento();
        $establ->ruta_imagen_establ = '';
        $establ->cod_establec = '123';
        $establ->nom_establec = 'Establecimiento 2';
        $establ->nom_corto_establec = 'EST2';
        $establ->telefono = '2222222';
        $establ->celular = '3222222222';
        $establ->direccion = 'Calle 50';
        $establ->correo = 'establ2@establ2.com';
        $establ->tipo_establec = 'Propiedad mixta';
        $establ->estado = 'A';
        $establ->creado_e = $date;
        $establ->actualizado_e = $date;
        $establ->save();
    }
}
