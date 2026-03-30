<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index() {
        // Obtenemos todos los registros de la tabla 'Estudiante'
        $calificaciones = Estudiante::all();
        return view('cpanel.alumnos.indexalumnos', compact('calificaciones'));
    }

    public function store(Request $request) {
        // 1. Validamos solo lo que existe en la tabla Estudiante
        $request->validate([
            'nombre'       => 'required|string|max:50',
            'apellido_p'   => 'required|string|max:50',
            'apellido_m'   => 'required|string|max:50',
            'curp'         => 'required|string|max:18|unique:Estudiante,curp',
            'sexo'         => 'required|string|max:1',
            'fecha_nac'    => 'required|date',
            'no_telefono'  => 'required|string|max:15',
            'ciudad'       => 'nullable|string|max:50',
            'calle'        => 'nullable|string|max:50',
            'numero'       => 'nullable|string|max:10',
        ]);

        // 2. Guardamos
        Estudiante::create($request->all());

        return redirect()->route('alumnos.index')->with('success', '¡Estudiante guardado en ADROA!');
    }

    public function edit($id) {
        $alumno = Estudiante::findOrFail($id);
        return view('cpanel.alumnos.alumnos-edit', compact('alumno'));
    }

    public function update(Request $request, $id) {
        $alumno = Estudiante::findOrFail($id);

        // 3. Validación de actualización (excluyendo el ID actual para el UNIQUE)
        $request->validate([
            'nombre'      => 'required|string',
            'apellido_p'  => 'required|string',
            'curp'        => 'required|string|max:18|unique:Estudiante,curp,' . $id . ',id_estudiante',
            'no_telefono' => 'required|string',
        ]);

        $alumno->update($request->all());
        return redirect()->route('alumnos.index')->with('success', 'Información actualizada.');
    }

    public function destroy($id) {
        $alumno = Estudiante::findOrFail($id);
        $alumno->delete();
        return redirect()->route('alumnos.index')->with('success', 'Registro eliminado.');
    }

    public function generarPDF() {
        $alumnos = Estudiante::all();
        $pdf = Pdf::loadView('cpanel.Reportes.pdfAlumnos', compact('alumnos'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('reporte_alumnos_' . date('Ymd') . '.pdf');
    }
}
