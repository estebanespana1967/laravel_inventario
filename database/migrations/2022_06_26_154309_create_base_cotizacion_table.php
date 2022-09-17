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
        Schema::create('base_cotizacion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cotizacion_detalle_id');
            $table->unsignedBigInteger('base_crema_id');
            $table->timestamps();
            $table->foreign('cotizacion_detalle_id')
            ->references('id')
            ->on('cotizacion_detalle')
            ->onDelete('cascade');
            $table->foreign('base_crema_id')
            ->references('id')
            ->on('base_crema')
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
        Schema::dropIfExists('base_cotizacion');
    }
};
