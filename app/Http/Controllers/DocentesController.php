<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Docente;

class DocentesController extends Controller
{
    /**
     * [R]EAD - Muestra la tabla de docentes
     */
    public function index()
    {
        // Traemos todos los registros de la tabla 'Docente'
        $docentes = Docente::all();
        return view('cpanel.docentes.indexdocentes', compact('docentes'));
    }

    /**
     * [C]REATE - Procesa el formulario desde el Modal o Vista
     */
    public function store(Request $request)
    {
        // Validación ajustada a los nuevos campos desglosados
        $request->validate([
            'nombre'     => 'required|string|max:50',
            'apellido_p' => 'required|string|max:50',
            'apellido_m' => 'nullable|string|max:50',
            'curp'       => 'required|string|max:18|unique:docentes,curp',
            'rfc'        => 'required|string|max:13|unique:docentes,rfc',
            'telefono'   => 'nullable|string|max:15',
            'estudios'   => 'nullable|string|max:100',
        ]);

        // Crea el registro usando mass assignment (recuerda configurar $fillable en el Modelo)
        Docente::create($request->all());

        return redirect()->route('docentes.index')->with('success', 'Docente registrado exitosamente.');
    }

    /**
     * [U]PDATE - Procesa la edición (Independiente o vía Modal)
     */
    public function update(Request $request, $id)
    {
        // Buscamos por la nueva llave primaria id_docente
        $docente = Docente::findOrFail($id);

        $request->validate([
            'nombre'     => 'required|string|max:50',
            'apellido_p' => 'required|string|max:50',
            'curp' => 'required|string|max:18|unique:docentes,curp,' . $id . ',id_docente',
            'rfc'  => 'required|string|max:13|unique:docentes,rfc,' . $id . ',id_docente',
        ]);

        $docente->update($request->all());

        return redirect()->route('docentes.index')->with('success', 'Información del docente actualizada.');
    }

    /**
     * [D]ELETE - Elimina un docente
     */
    public function destroy($id)
    {
        $docente = Docente::findOrFail($id);
        $docente->delete();

        return redirect()->route('docentes.index')->with('success', 'Docente eliminado correctamente.');
    }
    /**
     * [E]DIT - Muestra el formulario para editar un docente específico
     */
    public function edit($id)
    {
        // Buscamos al docente por su nueva llave primaria
        $docente = Docente::findOrFail($id);

        // Retornamos la vista que ya tienes creada para editar
        return view('cpanel.docentes.docentes-edit', compact('docente'));
    }
    /**
     * EXPORTAR CSV - Genera reporte con la estructura de nombres desglosados
     */
    public function exportarExcel()
    {
        $docentes = Docente::all();

        if ($docentes->isEmpty()) {
            return redirect()->route('docentes.index')->with('error', 'No hay registros para exportar.');
        }

        $filename = "reporte_docentes_" . date('Ymd_His') . ".csv";

        $headers = [
            "Content-Type"              => "text/csv; charset=UTF-8",
            "Content-Disposition"       => "attachment; filename=$filename",
            "Pragma"                    => "no-cache",
            "Cache-Control"             => "must-revalidate, post-check=0, pre-check=0",
            "Expires"                   => "0"
        ];

        $callback = function() use ($docentes) {
            $file = fopen('php://output', 'w');

            // Añadir BOM para que Excel reconozca tildes y eñes
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Encabezados basados en tu SQL
            fputcsv($file, ['ID', 'Nombre', 'Apellido Paterno', 'Apellido Materno', 'CURP', 'RFC', 'Teléfono', 'Estudios']);

            foreach ($docentes as $docente) {
                fputcsv($file, [
                    $docente->id_docente,
                    $docente->nombre,
                    $docente->apellido_p,
                    $docente->apellido_m,
                    $docente->curp,
                    $docente->rfc,
                    $docente->telefono,
                    $docente->estudios,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
