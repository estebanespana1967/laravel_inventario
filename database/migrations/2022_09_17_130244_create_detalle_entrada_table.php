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
        Schema::create('detalle_entrada', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_encabezado_entrada');
            $table->unsignedBigInteger('id_materia_prima');
            $table->string('cantidad_materia_prima');
            $table->string('unidad_medida');
            $table->double('costo', 8, 2);
            $table->string('serie');
            $table->string('lote');
            $table->date('fecha_vencimiento');
            $table->timestamps();
            $table->foreign('id_encabezado_entrada')
            ->references('id')
            ->on('encabezado_entrada')
            ->onDelete('cascade');
            $table->foreign('id_empresa')
            ->references('id')
            ->on('empresas')
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
        Schema::dropIfExists('detalle_entrada');
    }
};
