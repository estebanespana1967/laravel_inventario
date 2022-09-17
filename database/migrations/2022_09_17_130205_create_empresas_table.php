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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_empresa');
            $table->string('rut_empresa');
            $table->string('dv_empresa');
            $table->string('nombre_empresa');
            $table->string('nombre_fantasia');
            $table->string('giro_comercial');
            $table->string('direccion_empresa');
            $table->string('comuna_empresa');
            $table->string('ciudad_empresa');
            $table->string('telefono_empresa');
            $table->string('email_empresa');
            $table->string('contacto');
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
        Schema::dropIfExists('empresas');
    }
};
