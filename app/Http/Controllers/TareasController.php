<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use App\Models\Materia;

class TareasController extends Controller
{
    // [R]EAD - Muestra la tabla de tareas
    public function index()
    {
        $tareas = Tarea::with('materia')->get();
        $materias = Materia::all();
        // ✅ APUNTA A resources/views/cpanel/tareas/indextareas.blade.php
        return view('cpanel.tareas.indextareas', compact('tareas', 'materias'));
    }

    // [C]REATE - Procesa el formulario del modal
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'materia_id' => 'required|exists:materias,id',
            'fecha_entrega' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);

        Tarea::create([
            'titulo' => $request->titulo,
            'materia_id' => $request->materia_id,
            'fecha_entrega' => $request->fecha_entrega,
            'descripcion' => $request->descripcion ?? 'Sin descripción',
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea registrada exitosamente.');
    }

    // [U]PDATE (Edit) - Muestra el formulario de edición
    public function edit(Tarea $tarea)
    {
        $materias = Materia::all();
        return view('cpanel.tareas.tareas-edit', compact('tarea', 'materias'));
    }

    // [U]PDATE (Update) - Procesa la actualización
    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'materia_id' => 'required|exists:materias,id',
            'fecha_entrega' => 'required|date',
        ]);

        $tarea->update($request->all());

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada correctamente.');
    }

    // [D]ELETE - Elimina una tarea
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada.');
    }
}
