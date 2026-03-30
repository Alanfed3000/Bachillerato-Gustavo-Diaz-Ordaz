@extends('cpanel.plantilla')

@section('content')
    <section class="content-section active">
        <div class="module-card d-flex justify-content-between align-items-center">
            <div>
                <h2>📝 Gestión de Tareas</h2>
                <p>Administra las entregas del Bachillerato Gustavo Díaz Ordaz.</p>
            </div>
            <button class="btn btn-primary" onclick="document.getElementById('modalRegistroTarea').style.display='block'" style="background-color: #4e73df; color: white; border: none; padding: 10px 20px; border-radius: 5px;">
                + Registrar Nueva Tarea
            </button>
        </div>

        <div class="module-card">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                <tr style="border-bottom: 2px solid #eee; text-align: left;">
                    <th>Materia</th>
                    <th>Titulo</th>
                    <th>Fecha Límite</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tareas as $tarea)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td>{{ $tarea->materia->nombre_materia}}</td>
                        <td>{{ $tarea->titulo }}</td>
                        <td>{{ \Carbon\Carbon::parse($tarea->fecha_entrega)->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('tareas.edit', $tarea->id) }}" style="color: #4e73df; text-decoration: none; margin-right: 10px;">Editar</a>
                            <form action="{{ route('tareas.destroy', $tarea->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" style="color: red; background: none; border: none; cursor: pointer;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <div id="modalRegistroTarea" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
        <div style="background-color: white; margin: 10% auto; padding: 20px; width: 40%; border-radius: 8px;">
            <h3>Nueva Tarea</h3>
            <form action="{{ route('tareas.store') }}" method="POST">
                @csrf
                <label>Título:</label>
                <input type="text" name="titulo" class="form-control" required style="width: 100%; margin-bottom: 10px;">

                <label>Materia:</label>
                <select name="materia_id" class="form-control" style="width: 100%; margin-bottom: 10px;">
                    @foreach($materias as $materia)
                        <option value="{{ $materia->id }}">{{ $materia->nombre_materia }}</option>
                    @endforeach
                </select>

                <label>Fecha:</label>
                <input type="date" name="fecha_entrega" class="form-control" style="width: 100%; margin-bottom: 10px;">

                <div style="text-align: right; margin-top: 15px;">
                    <button type="button" onclick="document.getElementById('modalRegistroTarea').style.display='none'">Cancelar</button>
                    <button type="submit" style="background-color: #4e73df; color: white; border: none; padding: 5px 15px;">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
