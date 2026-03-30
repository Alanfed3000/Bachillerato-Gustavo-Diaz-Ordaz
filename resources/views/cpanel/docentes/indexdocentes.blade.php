@extends('cpanel.plantilla')

@section('title', 'Gestión de Docentes')

@section('content')
    <section class="content-section active" id="seccion-docentes">
        <div class="main-table-container module-card">
            <div class="table-header-controls" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">

                {{-- Buscador --}}
                <input type="text" id="buscar-docente" placeholder="Buscar por nombre, CURP o RFC..." style="padding: 10px; border: 1px solid #ccc; border-radius: 4px; flex-grow: 1; max-width: 50%; font-size: 14px; margin-right: 15px;">

                <div style="display: flex; gap: 10px;">
                    {{-- Exportar CSV --}}
                    <a href="{{ route('docentes.exportar') }}" class="btn btn-info" style="padding: 10px 15px; background-color: #17a2b8; color: white; border-radius: 4px; text-decoration: none; font-size: 14px;">
                        ⬇️ Exportar CSV
                    </a>

                    {{-- Botón que activa el modal de creación --}}
                    <button class="btn btn-success" id="open-create-docente-modal" style="padding: 10px 15px; font-size: 14px;">
                        ➕ Crear Docente
                    </button>
                </div>
            </div>

            <h2>👨‍🏫 Listado y Gestión de Docentes</h2>

            {{-- Mensajes de éxito --}}
            @if(session('success'))
                <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                    {{ session('success') }}
                </div>
            @endif

            <table class="data-table">
                <thead>
                <tr>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 30%;">Nombre Completo</th>
                    <th style="width: 20%;">CURP / RFC</th>
                    <th style="width: 20%;">Estudios / Área</th>
                    <th style="width: 25%; text-align: center;">Acciones</th>
                </tr>
                </thead>
                <tbody id="tabla-docentes">
                @forelse($docentes as $docente)
                    <tr>
                        {{-- Usamos id_docente según tu nuevo SQL --}}
                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">{{ $docente->id_docente }}</td>

                        {{-- Concatenación de nombres y apellidos --}}
                        <td style="padding: 10px; border: 1px solid #ddd;">
                            {{ $docente->nombre }} {{ $docente->apellido_p }} {{ $docente->apellido_m }}
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">
                            <small><strong>C:</strong> {{ $docente->curp }}<br><strong>R:</strong> {{ $docente->rfc }}</small>
                        </td>

                        <td style="padding: 10px; border: 1px solid #ddd;">{{ $docente->estudios }}</td>

                        <td style="padding: 10px; border: 1px solid #ddd; text-align: center;">
                            {{-- Botón Modificar: Redirige a la vista de edición independiente --}}
                            <a href="{{ route('docentes.edit', $docente->id_docente) }}" class="btn btn-modify" style="text-decoration: none; margin-right: 5px;">
                                Modificar
                            </a>


                            {{-- Botón Eliminar --}}
                            <form action="{{ route('docentes.destroy', $docente->id_docente) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete" onclick="return confirm('¿Estás seguro de eliminar a {{ $docente->nombre }}?');">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 20px; text-align: center; color: #888;">No hay registros disponibles.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div style="margin-top: 25px;">
                <a href="{{ route('reportes.pdf') }}" target="_blank" class="btn btn-primary" style="text-decoration: none; padding: 10px 20px;">
                    📄 Generar Reporte PDF
                </a>
            </div>
        </div>
    </section>

    {{-- INCLUSIÓN DEL MODAL DE CREACIÓN (Archivo independiente) --}}
    @include('cpanel.docentes.createdocentes')

@endsection

@section('scripts')
    <script>
        // Control del Modal de Creación
        const modal = document.getElementById('create-docente-modal');
        const openBtn = document.getElementById('open-create-docente-modal');
        const closeBtn = document.getElementById('close-create-docente-modal');

        if(openBtn) {
            openBtn.onclick = function() {
                modal.style.display = "block";
            }
        }

        if(closeBtn) {
            closeBtn.onclick = function() {
                modal.style.display = "none";
            }
        }

        // Cerrar modal al hacer clic fuera de él
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        // Buscador básico en tiempo real
        document.getElementById('buscar-docente').addEventListener('keyup', function() {
            let filtro = this.value.toLowerCase();
            let filas = document.querySelectorAll('#tabla-docentes tr');

            filas.forEach(fila => {
                let texto = fila.innerText.toLowerCase();
                fila.style.display = texto.includes(filtro) ? '' : 'none';
            });
        });
    </script>
@endsection
