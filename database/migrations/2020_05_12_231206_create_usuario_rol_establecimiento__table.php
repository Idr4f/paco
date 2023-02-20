<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuarioRolEstablecimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_rol_establecimiento', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_usuario')->unsigned();
            $table->bigInteger('id_rol')->unsigned();
            $table->bigInteger('id_establecimiento')->unsigned();
            $table->string('num_inmueble');
            $table->timestamps();
            $table->foreign('id_usuario')->references('id')->on('users');
            $table->foreign('id_rol')->references('id')->on('roles');
            $table->foreign('id_establecimiento')->references('id')->on('establecimientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_rol_establecimiento');
    }
}
