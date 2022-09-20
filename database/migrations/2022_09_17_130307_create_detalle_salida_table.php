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
        Schema::create('detalle_salida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_encabezado_salida');
            $table->unsignedBigInteger('id_materia_prima');
            $table->double('cantidad_materia_prima', 8, 2);
            $table->string('unidad_medida');
            $table->double('costo', 8, 2);
            $table->string('serie');
            $table->string('lote');
            $table->date('fecha_vencimiento');
            $table->timestamps();
            $table->foreign('id_encabezado_salida')
            ->references('id')
            ->on('encabezado_salida')
            ->onDelete('cascade');
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
        Schema::dropIfExists('detalle_salida');
    }
};
