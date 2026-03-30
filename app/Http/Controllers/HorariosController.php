<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorariosController extends Controller
{
    public function index()
    {
        // Ordenamos por día y hora
        $horarios = Horario::orderByRaw("FIELD(dia, 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes')")
            ->orderBy('hora_inicio')
            ->get();
        return view('cpanel.horario.indexhorario', compact('horarios'));
    }

    public function store(Request $request)
    {
        // Es buena práctica validar antes de crear
        $request->validate([
            'dia' => 'required',
            'materia' => 'required|string|max:255',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        Horario::create($request->all());
        return redirect()->route('horario.index')->with('success', 'Horario agregado correctamente.');
    }

    public function edit(Horario $horario)
    {
        return view('cpanel.horario.horario-edit', compact('horario'));
    }

    public function update(Request $request, Horario $horario)
    {
        $request->validate([
            'dia' => 'required',
            'materia' => 'required|string|max:255',
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
        ]);

        $horario->update($request->all());

        return redirect()->route('horario.index')->with('success', 'Horario actualizado correctamente.');
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->back()->with('success', 'Entrada de horario eliminada.');
    }
}
