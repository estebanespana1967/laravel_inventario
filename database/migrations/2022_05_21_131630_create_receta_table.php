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
        Schema::create('receta', function (Blueprint $table) {
            $table->id();
            $table->integer('numero_interno');
            $table->string('tipo_preparado');
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('doctor_id');
            $table->date('fecha_receta')->nullable();
            $table->date('fecha_recepcion')->nullable();
            $table->integer('cantidad_dias');
            $table->integer('posologia_diaria')->nullable();
            $table->string('serie')->nullable();  
            $table->integer('numero_controlado')->nullable();  
            $table->string('rut_adquirente',10)->nullable();
            $table->string('dv_adquirente',1)->nullable();
            $table->string('nombre_completo_adquirente',100)->nullable();
            $table->string('direccion_adquirente')->nullable();
            $table->string('establecimiento')->nullable();
            $table->string('rut_establecimiento',10)->nullable();
            $table->string('dv_establecimiento',1)->nullable();
            $table->string('cantidad_despachada')->nullable();
            $table->string('director_tecnico')->nullable();
            $table->string('rut_dt',10)->nullable();
            $table->string('dv_dt',1)->nullable();
            $table->date('fecha_entregado')->nullable();
            $table->string('libro_numero',20)->nullable;
            $table->string('tipo_receta',10)->nullable;
            $table->timestamps();
            $table->foreign('paciente_id')
            ->references('id')
            ->on('paciente')
            ->onDelete('cascade');
            $table->foreign('doctor_id')
            ->references('id')
            ->on('medico')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receta');
    }
};
