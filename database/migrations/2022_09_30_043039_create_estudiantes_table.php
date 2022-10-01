<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('carne');
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('correo_electronico');
            $table->integer('id_tipos_sangre');
            $table->date('fecha_nacimiento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
};
