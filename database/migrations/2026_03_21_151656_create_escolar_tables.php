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
        Schema::create('Tutor', function (Blueprint $table) {
            $table->id('id_tutor');
            $table->string('nombre', 50);
            $table->string('apellido_p', 50);
            $table->string('apellido_m', 50);
            $table->string('curp', 18);
            $table->string('no_telefono', 15);
            $table->string('ciudad', 50);
            $table->string('calle', 50);
            $table->string('numero', 10);
        });

        // Tabla pivote Representa
        Schema::create('Representa', function (Blueprint $table) {
            // CAMBIO IMPORTANTE: Usamos unsignedBigInteger para que coincida con la tabla Estudiante
            $table->unsignedBigInteger('id_estudiante');
            $table->unsignedBigInteger('id_tutor');

            $table->primary(['id_estudiante', 'id_tutor']);

            // Ahora sí las llaves foráneas serán compatibles
            $table->foreign('id_estudiante')
                ->references('id_estudiante')
                ->on('Estudiante')
                ->onDelete('cascade');

            $table->foreign('id_tutor')
                ->references('id_tutor')
                ->on('Tutor')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Corregimos para que borre las tablas reales en orden inverso
        Schema::dropIfExists('Representa');
        Schema::dropIfExists('Tutor');
    }
};
