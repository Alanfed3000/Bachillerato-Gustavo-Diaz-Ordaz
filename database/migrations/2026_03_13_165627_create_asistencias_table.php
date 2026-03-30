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
        Schema::create('asistencias', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_estudiante');
            $table->foreign('id_estudiante')
                ->references('id_estudiante')
                ->on('Estudiante')
                ->onDelete('cascade');

            $table->foreignId('horario_id')->constrained('horarios')->onDelete('cascade');

            $table->date('fecha');
            $table->enum('estado', ['presente', 'falta', 'retardo', 'justificado']);
            $table->text('observaciones')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asistencias');
    }
};
