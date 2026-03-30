@extends('cpanel.plantilla')

@section('content')
    <section class="content-section active">
        <div class="module-card">
            <h2>Editar Tarea</h2>
            <p>Modifica los detalles de la tarea seleccionada.</p>
            <hr>

            <form action="{{ route('tareas.update', $tarea->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Título de la Tarea:</label>
                    <input type="text" name="titulo" value="{{ $tarea->titulo }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Materia:</label>
                    <select name="materia_id" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                        @foreach($materias as $materia)
                            <option value="{{ $materia->id }}" {{ $tarea->materia_id == $materia->id ? 'selected' : '' }}>
                                {{ $materia->nombre_materia }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Fecha de Entrega:</label>
                    <input type="date" name="fecha_entrega" value="{{ $tarea->fecha_entrega }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; margin-bottom: 5px;">Descripción:</label>
                    <textarea name="descripcion" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" rows="4">{{ $tarea->descripcion }}</textarea>
                </div>

                <div style="margin-top: 20px;">
                    <a href="{{ route('tareas.index') }}" style="padding: 10px 15px; background: #858796; color: white; text-decoration: none; border-radius: 4px;">Cancelar</a>
                    <button type="submit" style="padding: 10px 15px; background: #4e73df; color: white; border: none; border-radius: 4px; cursor: pointer;">Actualizar Tarea</button>
                </div>
            </form>
        </div>
    </section>
@endsection
