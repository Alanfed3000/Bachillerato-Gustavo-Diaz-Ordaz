@extends('cpanel.plantilla')

@section('content')
    <div class="module-card">
        <h2>Editar Horario</h2>

        @if ($errors->any())
            <div style="background: #f8d7da; color: #721c24; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('horario.update', $horario->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Día:</label>
            <select name="dia" style="width: 100%; padding: 8px; margin-bottom: 10px;">
                @foreach(['Lunes','Martes','Miércoles','Jueves','Viernes'] as $dia)
                    <option value="{{ $dia }}" {{ $horario->dia == $dia ? 'selected' : '' }}>{{ $dia }}</option>
                @endforeach
            </select>

            <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                <div style="flex: 1;">
                    <label>Hora Inicio:</label>
                    <input type="time" name="hora_inicio" value="{{ $horario->hora_inicio }}" style="width: 100%; padding: 8px;" required>
                </div>
                <div style="flex: 1;">
                    <label>Hora Fin:</label>
                    <input type="time" name="hora_fin" value="{{ $horario->hora_fin }}" style="width: 100%; padding: 8px;" required>
                </div>
            </div>

            <label>Materia:</label>
            <input type="text" name="materia" value="{{ $horario->materia }}" style="width: 100%; padding: 8px; margin-bottom: 10px;" required>

            <label>Aula:</label>
            <input type="text" name="aula" value="{{ $horario->aula }}" style="width: 100%; padding: 8px; margin-bottom: 20px;">

            <button type="submit" style="background: #1cc88a; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                Actualizar Cambios
            </button>
            <a href="{{ route('horario.index') }}" style="margin-left: 10px; color: #858796;">Cancelar</a>
        </form>
    </div>
@endsection
