<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolOpcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_opciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_rol');
            $table->bigInteger('id_opcion');
            $table->string('creacion');
            $table->string('lectura');
            $table->string('modificacion');
            $table->string('eliminacion');
            $table->string('estado');
            $table->timestamps();
            $table->foreign('id_rol')->references('id')->on('roles');
            $table->foreign('id_opcion')->references('id')->on('opciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rol_opciones');
    }
}
