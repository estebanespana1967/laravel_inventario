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
        Schema::create('preparado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receta_id');
            $table->unsignedBigInteger('materia_prima_id');
            $table->float('cantidad_materia_prima');
            $table->float('costo_materia_prima');
            $table->timestamps();
            $table->foreign('receta_id')
            ->references('id')
            ->on('receta')
            ->onDelete('cascade');
            $table->foreign('materia_prima_id')
            ->references('id')
            ->on('materia_prima')
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
        Schema::dropIfExists('preparado');
    }
};
