@extends('cpanel.plantilla')

@section('title', 'Foros de Discusión')

@section('content')

    <section class="content-section active" id="seccion-foros">

        <div class="module-card">
            <h2>💬 Foros de Discusión</h2>
            <p>Participa en discusiones académicas, haz preguntas a tus compañeros y resuelve dudas con tu docente.</p>
        </div>

        <div class="module-card">
            <h3>Foros Activos</h3>
            <ul style="list-style-type: none; padding-left: 0;">
                <li style="margin-bottom: 12px; border-bottom: 1px dashed var(--color-gris-claro); padding-bottom: 8px;">**Foro de Cálculo:** Preguntas sobre derivadas. <span style="font-size: 0.9em; color: var(--color-gris-oscuro);"> (30 respuestas)</span></li>
                <li style="margin-bottom: 12px; border-bottom: 1px dashed var(--color-gris-claro); padding-bottom: 8px;">**Foro de Programación:** Proyectos finales. <span style="font-size: 0.9em; color: var(--color-gris-oscuro);"> (15 respuestas)</span></li>
                <li style="margin-bottom: 12px;">**Foro General:** Anuncios importantes. <span style="font-size: 0.9em; color: var(--color-gris-oscuro);"> (5 respuestas)</span></li>
            </ul>
        </div>

    </section>

@endsection
