<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Estudiante; // 1. Cambiamos Estudiante por Estudiante
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function mostrarDashboard()
    {
        // 1. Datos para la gráfica
        $datos = Docente::select('estudios', DB::raw('count(*) as total'))
            ->groupBy('estudios')
            ->pluck('total', 'estudios')
            ->all();

        $materias = array_keys($datos);
        $conteos = array_values($datos);

        // 2. Datos para las tarjetas
        // Usamos Estudiante en lugar de Estudiante para ser consistentes con tu DB
        $totalAlumnos = Estudiante::count();
        $totalDocentes = Docente::count();

        // 2.1 Evitar error de columna 'calificacion' si aún no existe o está vacía
        // Por ahora lo ponemos en 0 para que cargue el dashboard
        $promedioGeneral = 0;

        // 3. ENVIAR TODO JUNTO (Asegúrate de que los nombres coincidan con compact)
        return view('cpanel.dashboard', compact(
            'materias',
            'conteos',
            'totalAlumnos',
            'totalDocentes',
            'promedioGeneral'
        ));
    }
}
