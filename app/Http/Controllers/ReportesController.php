<?php

namespace App\Http\Controllers;

use App\Models\Docente; // Importamos el modelo
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // Asegúrate de tener instalada la librería DomPDF

class ReportesController extends Controller
{
    public function GenerarPDF()
    {
        // Traemos todos los docentes de la tabla 'docentes'
        $docentes = Docente::all();

        // Cargamos la vista y le pasamos los datos
        $pdf = Pdf::loadView('cpanel.reportes.pdfDocentes', compact('docentes'));

        // Retornamos el PDF para visualizar en el navegador
        return $pdf->stream('Reporte_Docentes_Bachillerato.pdf');
    }
}
