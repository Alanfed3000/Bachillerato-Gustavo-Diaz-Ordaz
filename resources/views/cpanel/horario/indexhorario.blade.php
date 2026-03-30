@extends('cpanel.plantilla')

@section('content')
    <section class="content-section active">
        <div class="module-card d-flex justify-content-between align-items-center">
            <div>
                <h2>📅 Gestión de Horarios</h2>
                <p>Organiza las horas de clase y asignación de aulas.</p>
            </div>
            <button class="btn btn-primary" onclick="document.getElementById('modalHorario').style.display='block'" style="background-color: #1cc88a; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                + Agregar Hora
            </button>
        </div>

        @if(session('success'))
            <div style="margin: 20px; padding: 15px; background-color: #d4edda; color: #155724; border-radius: 5px; border: 1px solid #c3e6cb;">
                {{ session('success') }}
            </div>
        @endif

        <div class="module-card">
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <thead>
                <tr style="background-color: #f8f9fc; border-bottom: 2px solid #eee; text-align: left;">
                    <th style="padding: 12px;">Día</th>
                    <th style="padding: 12px;">Horario</th>
                    <th style="padding: 12px;">Materia</th>
                    <th style="padding: 12px;">Aula</th>
                    <th style="padding: 12px; text-align: center;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($horarios as $h)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px;"><strong>{{ $h->dia }}</strong></td>
                        <td style="padding: 12px;">{{ date('H:i', strtotime($h->hora_inicio)) }} - {{ date('H:i', strtotime($h->hora_fin)) }}</td>
                        <td style="padding: 12px;">{{ $h->materia }}</td>
                        <td style="padding: 12px;">{{ $h->aula ?? 'N/A' }}</td>
                        <td style="padding: 12px; text-align: center;">
                            <a href="{{ route('horario.edit', $h->id) }}" style="text-decoration: none; color: #4e73df; font-weight: 600; margin-right: 15px;">
                                Editar
                            </a>
                            <form action="{{ route('horario.destroy', $h->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #e74a3b; border: none; background: none; cursor: pointer; font-weight: bold;" onclick="return confirm('¿Eliminar esta hora?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 20px; text-align: center; color: #858796;">No hay horarios registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>

    <div id="modalHorario" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
        <div style="background-color: white; margin: 10% auto; padding: 25px; width: 40%; border-radius: 10px;">
            <h3>Registrar Nueva Hora</h3>
            <hr>
            <form action="{{ route('horario.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 10px;">
                    <label>Día:</label>
                    <select name="dia" style="width: 100%; padding: 8px;" required>
                        <option value="Lunes">Lunes</option>
                        <option value="Martes">Martes</option>
                        <option value="Miércoles">Miércoles</option>
                        <option value="Jueves">Jueves</option>
                        <option value="Viernes">Viernes</option>
                    </select>
                </div>
                <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                    <div style="flex: 1;">
                        <label>Hora Inicio:</label>
                        <input type="time" name="hora_inicio" style="width: 100%; padding: 8px;" required>
                    </div>
                    <div style="flex: 1;">
                        <label>Hora Fin:</label>
                        <input type="time" name="hora_fin" style="width: 100%; padding: 8px;" required>
                    </div>
                </div>
                <div style="margin-bottom: 10px;">
                    <label>Materia:</label>
                    <input type="text" name="materia" style="width: 100%; padding: 8px;" required>
                </div>
                <div style="margin-bottom: 15px;">
                    <label>Aula:</label>
                    <input type="text" name="aula" style="width: 100%; padding: 8px;">
                </div>
                <div style="text-align: right;">
                    <button type="button" onclick="document.getElementById('modalHorario').style.display='none'" style="padding: 8px 15px; background: #858796; color: white; border: none; border-radius: 4px;">Cancelar</button>
                    <button type="submit" style="padding: 8px 15px; background: #1cc88a; color: white; border: none; border-radius: 4px;">Guardar</button>
                </div>
            </form>
        </div>
    </div>
@endsection
