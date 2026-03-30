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
        Schema::create('Estudiante', function (Blueprint $table) {
            $table->id('id_estudiante'); // Esto arregla el error de 'id_alumno' o 'id'
            $table->string('nombre', 50);
            $table->string('apellido_p', 50);
            $table->string('apellido_m', 50);
            $table->string('curp', 18)->unique();
            $table->char('sexo', 1);
            $table->date('fecha_nac');
            $table->string('no_telefono', 15);
            $table->string('ciudad', 50);
            $table->string('calle', 50);
            $table->string('numero', 10);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Estudiante');
    }
};
