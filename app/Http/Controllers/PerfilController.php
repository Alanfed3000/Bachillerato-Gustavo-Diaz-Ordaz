<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PerfilController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'matricula' => 'nullable|string|max:50',
            'telefono' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->name = $request->name;
        $user->matricula = $request->matricula;
        $user->telefono = $request->telefono;

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            // Guardar la nueva foto en storage/app/public/perfiles
            $path = $request->file('foto')->store('perfiles', 'public');
            $user->foto = $path;
        }

        $user->save();

        return back()->with('success', 'Perfil actualizado con éxito.');
    }
}
