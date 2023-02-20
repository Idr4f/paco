<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablecimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establecimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ruta_imagen_establ');
            $table->string('cod_establec');
            $table->string('nom_establec');
            $table->string('nom_corto_establec');
            $table->string('telefono');
            $table->string('celular');
            $table->string('direccion');
            $table->string('correo');
            $table->string('tipo_establec');
            $table->string('estado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('establecimientos');
    }
}
