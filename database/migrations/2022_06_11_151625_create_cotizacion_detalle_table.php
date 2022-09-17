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
        Schema::create('cotizacion_detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->integer('cantidad_capsulas');
            $table->integer('tipo_cotizacion'); //valores 1=capsulas, 2=semisolidos
            $table->unsignedBigInteger('convenio_id');
            $table->date('fecha_cotizacion');
            $table->date('fecha_elaboracion');
            $table->date('fecha_vencimiento');
            $table->string('estado',15)->default('COTIZADO');
            $table->string('responsable_entrega',50)->nullable();
                        
            $table->double('valor', 8, 2)->default(0.00);


            $table->timestamps();
            $table->foreign('paciente_id')
            ->references('id')
            ->on('paciente')
            ->onDelete('cascade');
            
            $table->foreign('convenio_id')
            ->references('id')
            ->on('convenio')
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
        Schema::dropIfExists('cotizacion_detalle');
    }
};
