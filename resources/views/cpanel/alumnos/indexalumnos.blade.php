@extends('cpanel.plantilla')

@section('content')
    <section class="content-section active">
        <div class="module-card d-flex justify-content-between align-items-center">
            <div>
                <h2>🎓 Área de Alumnos y Expediente</h2>
                <p>Accede a tu historial académico y consulta tus calificaciones.</p>
            </div>
            <div>
                <a href="{{ route('alumnos.pdf') }}" class="btn" style="background-color: #e74a3b; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; margin-right: 10px;">
                    <i class="fas fa-file-pdf"></i> Descargar PDF
                </a>

                <button class="btn btn-primary" onclick="document.getElementById('modalRegistroAlumno').style.display='block'" style="background-color: #4e73df; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                    + Agregar Estudiante
                </button>
            </div>
        </div>

        @if(session('success'))
            <div style="margin: 15px; padding: 10px; background-color: #d4edda; color: #155724; border-radius: 5px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="module-card">
            <h3>Lista de Estudiantes Registrados</h3>
            <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <thead>
                <tr style="background-color: #f8f9fc; border-bottom: 2px solid #eee; text-align: left;">
                    <th style="padding: 12px;">ID</th>
                    <th style="padding: 12px;">Nombre Completo</th>
                    <th style="padding: 12px;">CURP</th>
                    <th style="padding: 12px;">No. Teléfono</th>
                    <th style="padding: 12px; text-align: center;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($calificaciones as $cal)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px;">{{ $cal->id_estudiante }}</td>
                        <td style="padding: 12px;">{{ $cal->nombre }} {{ $cal->apellido_p }} {{ $cal->apellido_m }}</td>
                        <td style="padding: 12px;">{{ $cal->curp }}</td>
                        <td style="padding: 12px;">{{ $cal->no_telefono }}</td>
                        <td style="padding: 12px; text-align: center;">
                            {{-- Editamos usando id_estudiante --}}
                            <a href="{{ route('alumnos.edit', $cal->id_estudiante) }}" style="color: #4e73df; font-weight: 600; margin-right: 10px; text-decoration: none;">Editar</a>

                            {{-- Eliminamos usando id_estudiante --}}
                            <form action="{{ route('alumnos.destroy', $cal->id_estudiante) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background: none; color: #e74a3b; cursor: pointer; font-weight: 600;" onclick="return confirm('¿Eliminar registro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 20px; text-align: center; color: #858796;">
                            No hay estudiantes registrados.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- MODAL DE REGISTRO --}}
    <div id="modalRegistroAlumno" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
        <div style="background-color: white; margin: 5% auto; padding: 25px; width: 50%; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
            <h3 style="margin-top: 0;">👤 Registrar Nuevo Estudiante</h3>
            <hr>
            <form action="{{ route('alumnos.store') }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                    {{-- Datos Personales --}}
                    <div>
                        <label>Nombre(s):</label>
                        <input type="text" name="nombre" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>
                    <div>
                        <label>Apellido Paterno:</label>
                        <input type="text" name="apellido_p" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>
                    <div>
                        <label>Apellido Materno:</label>
                        <input type="text" name="apellido_m" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>
                    <div>
                        <label>CURP:</label>
                        <input type="text" name="curp" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" maxlength="18" required>
                    </div>
                    <div>
                        <label>Sexo:</label>
                        <select name="sexo" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>
                    <div>
                        <label>Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nac" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>
                    <div>
                        <label>Teléfono:</label>
                        <input type="text" name="no_telefono" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>

                    {{-- Dirección (Obligatorios según tu DB) --}}
                    <div>
                        <label>Ciudad:</label>
                        <input type="text" name="ciudad" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>
                    <div>
                        <label>Calle:</label>
                        <input type="text" name="calle" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>
                    <div>
                        <label>Número:</label>
                        <input type="text" name="numero" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" required>
                    </div>
                </div>
                <div style="text-align: right; margin-top: 20px;">
                    <button type="button" onclick="document.getElementById('modalRegistroAlumno').style.display='none'" style="padding: 8px 15px; background: #858796; color: white; border: none; border-radius: 4px; cursor: pointer;">Cancelar</button>
                    <button type="submit" style="padding: 8px 15px; background: #4e73df; color: white; border: none; border-radius: 4px; cursor: pointer;">Guardar Estudiante</button>
                </div>
            </form>
        </div>
    </div>
@endsection
