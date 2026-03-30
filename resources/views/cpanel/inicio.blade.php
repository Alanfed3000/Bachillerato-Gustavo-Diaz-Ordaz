@extends('cpanel.plantilla')

@section('title', 'Contenidos y Bienvenida')

@section('content')

    <section class="content-section active" id="seccion-contenidos">
        <div class="module-card">
            <h2>📚 Módulo de Bienvenida y Contenidos</h2>
            <p>Estimado estudiante, bienvenido a la plataforma. Esta es la sección principal donde encontrarás noticias y accesos rápidos.</p>
        </div>
        <div class="module-card">
            <h3>📖 Recursos y Documentación</h3>
            <p>Explora y descarga la documentación relevante para tu curso:</p>
            <ul>
                <li>Revisa tu malla curricular.</li>
                <li>Consulta las notas y evaluaciones.</li>
            </ul>
        </div>
        <div class="module-card">
            <h2>🔔 Próximos Eventos y Tareas</h2>
            <p>Asegúrate de contactar a tus profesores.</p>
        </div>
    </section>

@endsection

{{-- No se necesita @section('scripts') ni @section('styles') aquí, a menos que se requiera algo específico para el inicio --}}
