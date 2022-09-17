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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('tipo_movimiento');
            $table->string('numero_documento');
            $table->string('rut_movimiento');
            $table->string('dv_documento');
            $table->string('rut_responsable');
            $table->string('dv_responsable');
            $table->string('motivo_movimiento');
            $table->unsignedBigInteger('id_materia_prima');
            $table->double('cantidad', 8, 2);
            $table->double('stock_final', 8, 2);
            $table->timestamps();
            $table->foreign('id_materia_prima')
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
        Schema::dropIfExists('movimientos');
    }
};
