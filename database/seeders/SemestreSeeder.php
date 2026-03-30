<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Definimos los semestres usando tus columnas: dia, mes, anio
        $semestres = [
            ['id_semestre' => 1, 'dia' => 21, 'mes' => 3, 'anio' => 2026],
            ['id_semestre' => 2, 'dia' => 21, 'mes' => 8, 'anio' => 2026],
        ];

        foreach ($semestres as $semestre) {
            \App\Models\Semestre::updateOrCreate(
                ['id_semestre' => $semestre['id_semestre']],
                [
                    'dia'  => $semestre['dia'],
                    'mes'  => $semestre['mes'],
                    'anio' => $semestre['anio']
                ]
            );
        }
    }
}
