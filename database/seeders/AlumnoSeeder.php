<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlumnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Estudiante::create([
            'materia' => 'Física I',
            'calificacion' => 9.5,
            'docente' => 'Prof. Martínez'
        ]);

        \App\Models\Estudiante::create([
            'materia' => 'Química II',
            'calificacion' => 8.9,
            'docente' => 'Prof. Gómez'
        ]);
    }
}
