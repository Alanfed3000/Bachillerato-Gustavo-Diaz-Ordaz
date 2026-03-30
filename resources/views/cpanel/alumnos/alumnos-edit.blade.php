@extends('cpanel.plantilla')

@section('content')
    <div class="module-card" style="padding: 25px; margin: 20px auto; border-radius: 10px; background-color: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h2 style="margin-top: 0;">📝 Modificar Estudiante</h2>
        <p>Editando a: <strong>{{ $alumno->nombre }} {{ $alumno->apellido_p }}</strong></p>
        <hr>

        <form action="{{ route('alumnos.update', $alumno->id_estudiante) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-top: 20px;">
                {{-- Fila 1 --}}
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Nombre(s):</label>
                    <input type="text" name="nombre" value="{{ $alumno->nombre }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                </div>
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Apellido Paterno:</label>
                    <input type="text" name="apellido_p" value="{{ $alumno->apellido_p }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                </div>

                {{-- Fila 2 --}}
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Apellido Materno:</label>
                    <input type="text" name="apellido_m" value="{{ $alumno->apellido_m }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                </div>
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">CURP:</label>
                    <input type="text" name="curp" value="{{ $alumno->curp }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" maxlength="18" required>
                </div>

                {{-- Fila 3 --}}
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Ciudad:</label>
                    <input type="text" name="ciudad" value="{{ $alumno->ciudad }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                </div>
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Calle:</label>
                    <input type="text" name="calle" value="{{ $alumno->calle }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                </div>

                {{-- Fila 4 --}}
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Número:</label>
                    <input type="text" name="numero" value="{{ $alumno->numero }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                </div>
                <div>
                    <label style="display: block; font-weight: bold; margin-bottom: 5px;">Teléfono:</label>
                    <input type="text" name="no_telefono" value="{{ $alumno->no_telefono }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px;" required>
                </div>
            </div>

            {{-- SECCIÓN DE BOTONES --}}
            <div style="text-align: center; margin-top: 30px; display: flex; justify-content: center; gap: 15px;">
                <button type="submit" style="background-color: #4e73df; color: white; border: none; padding: 12px 25px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                    💾 Guardar Cambios
                </button>
                <a href="{{ route('alumnos.index') }}" style="background-color: #858796; color: white; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: bold;">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection
