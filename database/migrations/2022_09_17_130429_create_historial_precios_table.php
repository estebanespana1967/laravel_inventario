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
        Schema::create('historial_precios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_materia_prima');
            $table->double('precio_compra', 8, 2);
            $table->double('precio_venta', 8, 2);
            $table->date('fecha_precio');
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
        Schema::dropIfExists('historial_precios');
    }
};
