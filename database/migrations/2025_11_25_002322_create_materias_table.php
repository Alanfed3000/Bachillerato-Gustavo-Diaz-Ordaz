<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        // 1. Creamos Semestre primero en este mismo archivo para que ya exista
        Schema::create('Semestre', function (Blueprint $table) {
            $table->id('id_semestre');
            $table->integer('dia');
            $table->integer('mes');
            $table->integer('anio');
        });

        // 2. Ahora sí creamos Materia con su relación
        Schema::create('Materia', function (Blueprint $table) {
            $table->id('id_materia');
            $table->string('nombre', 100);
            $table->integer('no_horas')->nullable();
            $table->integer('creditos')->nullable();
            $table->string('area_formacion', 50)->nullable();
            $table->unsignedBigInteger('id_semestre')->nullable();

            $table->foreign('id_semestre')
                ->references('id_semestre')
                ->on('Semestre')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Materia');
        Schema::dropIfExists('Semestre');
    }
};
