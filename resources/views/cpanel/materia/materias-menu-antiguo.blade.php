@extends('cpanel.plantilla')

@section('title', 'Vista de Materias')

@section('content')

    <section class="content-section active" id="seccion-materias">

        <div class="module-card">
            <h2>📘 Contenido de Asignaturas</h2>
            <p>Selecciona una materia para acceder a su temario, unidades, recursos y actividades específicas.</p>
        </div>

        <div class="module-card">
            <h3>Materias Cursando</h3>
            <ul style="list-style-type: none; padding-left: 0;">
                <li style="margin-bottom: 8px;"><a href="#" style="color: var(--color-verde); text-decoration: none; font-weight: 600;">Introducción a la Programación</a></li>
                <li style="margin-bottom: 8px;"><a href="#" style="color: var(--color-verde); text-decoration: none; font-weight: 600;">Cálculo Diferencial</a></li>
                <li style="margin-bottom: 8px;"><a href="#" style="color: var(--color-verde); text-decoration: none; font-weight: 600;">Literatura Clásica</a></li>
            </ul>
        </div>

        <div class="module-card">
            <h3>Material General</h3>
            <p>Descarga el plan de estudios general del semestre.</p>
        </div>

    </section>

@endsection
