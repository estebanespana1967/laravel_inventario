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
        Schema::create('materia_prima', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_mp',150);
            $table->string('fecha_venci',10);
            $table->string('lote',50);
            $table->string('serie',50);
            $table->string('proveedor',50);
            $table->string('costo',10)->null();
            $table->string('venta',40);
            $table->string('stock',4);
            $table->string('controlado',1);
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
        Schema::dropIfExists('materia_prima');
    }
};
