@extends('cpanel.plantilla')
@section('title', 'Editar Materia')
@section('content')
    <section class="content-section active">
        <div class="module-card" style="padding: 25px; background: white; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
            <h2 style="margin-top: 0; color: #333;">✏️ Modificar Materia: {{ $materia->nombre }}</h2>
            <hr style="margin-bottom: 20px; border: 0; border-top: 1px solid #eee;">

            <form action="{{ route('materias.update', $materia->id_materia) }}" method="POST">
                @csrf
                @method('PUT')
                @include('cpanel.materia.form', ['materia' => $materia])
            </form>
        </div>
    </section>
@endsection
