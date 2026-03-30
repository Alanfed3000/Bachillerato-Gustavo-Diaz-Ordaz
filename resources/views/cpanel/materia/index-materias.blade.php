@extends('cpanel.plantilla')

@section('title', 'Gestión de Asignaturas')

@section('content')
    <section class="content-section active">

        <h3 style="margin-bottom: 20px;">
            Administración de Asignaturas 📘
        </h3>

        {{-- Botón para Crear Nueva Materia --}}
        <div style="margin-bottom: 25px; text-align: right;">
            <a href="{{ route('materias.create') }}" class="btn btn-primary" style="padding: 10px 18px; text-decoration: none; background-color: #007bff; color: white; border-radius: 4px;">
                ➕ Crear Nueva Asignatura
            </a>
        </div>

        {{-- Mensajes de Éxito/Error (Funcionalidad del CRUD) --}}
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ CONTENIDO PRINCIPAL: LISTADO DE MATERIAS CON BOTONES --}}
        <div class="main-table-container module-card" style="border: 1px solid #ccc; border-radius: 8px; padding: 20px;">
            <h4>Materias Registradas</h4>

            <table class="data-table" style="width: 100%; border-collapse: collapse; margin-top: 15px;">
                <thead>
                <tr style="background-color: #f8f9fa;">
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Clave</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: left;">Nombre de la Asignatura</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Créditos</th>
                    <th style="padding: 12px; border: 1px solid #ddd; text-align: center;">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($materias as $materia)
                    <tr>
                        {{-- Usamos 'id_materia' si es lo que quieres mostrar como clave, o el campo 'codigo' si existe --}}
                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $materia->id_materia }}</td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{-- CORRECCIÓN 1: Cambiar ->id por ->id_materia --}}
                            <a href="{{ route('materias.edit', $materia->id_materia) }}" style="text-decoration: none; color: #007bff; font-weight: bold;">
                                {{ $materia->nombre }} {{-- Verifica si el campo es 'nombre' o 'nombre_materia' en tu DB --}}
                            </a>
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $materia->creditos }}</td>

                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center; display: flex; justify-content: center; gap: 8px;">

                            {{-- Botón Modificar --}}
                            <a href="{{ route('materias.edit', $materia->id_materia) }}" class="btn btn-warning" style="background-color: #ffc107; padding: 5px 10px; border-radius: 4px; text-decoration: none; color: black;">
                                Editar
                            </a>

                            {{-- Formulario para Eliminar --}}
                            <form action="{{ route('materias.destroy', $materia->id_materia) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;" onclick="return confirm('¿Eliminar materia?')">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align: center; padding: 20px;">No hay asignaturas registradas.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        {{-- Puedes mantener el bloque de "Material General" si es relevante para el administrador --}}
        <div style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 20px; margin-top: 20px;">
            <h4>Material General</h4>
            <p>Descarga el plan de estudios general del semestre. (Funcionalidad pendiente)</p>
        </div>

    </section>
@endsection
