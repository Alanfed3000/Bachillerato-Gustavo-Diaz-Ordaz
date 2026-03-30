<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;

class MateriasController extends Controller
{
    // [R]EAD: Listar
    public function index()
    {
        $materias = Materia::all();
        return view('cpanel.materia.index-materias', compact('materias'));
    }

    // [C]REATE (Vista)
    public function create()
    {
        // Cambiamos el nombre de la vista a 'create-materias'
        return view('cpanel.materia.create-materias');
    }

    // [C]REATE (Guardar)
// [C]REATE (Guardar)
    public function store(Request $request)
    {
        // 1. Validamos solo reglas de campos
        $request->validate([
            'nombre'         => 'required|string|max:100',
            'no_horas'       => 'nullable|integer',
            'creditos'       => 'nullable|integer',
            'area_formacion' => 'nullable|string|max:50',
        ]);

        // 2. Creamos el registro asegurando que id_semestre tenga un valor
        Materia::create([
            'nombre'         => $request->nombre,
            'no_horas'       => $request->no_horas,
            'creditos'       => $request->creditos,
            'area_formacion' => $request->area_formacion,
            'id_semestre'    => $request->id_semestre ?? 1, // Si no viene en el form, ponemos 1 por defecto
        ]);

        return redirect()->route('materias.index')->with('success', 'Materia registrada correctamente.');
    }

    // [U]PDATE (Vista)
    public function edit(Materia $materia)
    {
        return view('cpanel.materia.edit-materias', compact('materia'));
    }

    // [U]PDATE (Guardar cambios)
    public function update(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
            'no_horas' => 'nullable|integer',
            'creditos' => 'nullable|integer',
            'area_formacion' => 'nullable|string',
        ]);

        $materia->update($request->all());

        return redirect()->route('materias.index')->with('success', 'Materia actualizada exitosamente.');
    }

    // [D]ELETE
    public function destroy(Materia $materia)
    {
        $materia->delete();
        return redirect()->route('materias.index')->with('success', 'Materia eliminada exitosamente.');
    }
}
