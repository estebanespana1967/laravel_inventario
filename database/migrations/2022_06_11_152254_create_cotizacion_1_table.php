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
        Schema::create('cotizacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cotizacion_detalle_id');
            $table->unsignedBigInteger('materia_prima_id');
            $table->float('cantidad_materia_prima');
            $table->float('costo_materia_prima');
            $table->timestamps();
            $table->foreign('cotizacion_detalle_id')
            ->references('id')
            ->on('cotizacion_detalle')
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
        Schema::dropIfExists('cotizacion');
    }
};
