@extends('cpanel.plantilla')

@section('title', 'Modificar Docente')

@section('content')
    <section class="content-section active">
        <div class="module-card">
            <h2>✏️ Modificar Docente</h2>
            <p>Editando a: **{{ $docente->nombre }} {{ $docente->apellido_p }} {{ $docente->apellido_m }}**</p>

            <form action="{{ route('docentes.update', $docente->id_docente) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Reutilizamos el mismo archivo form --}}
                @include('cpanel.docentes.form', ['docente' => $docente])
            </form>
        </div>
    </section>
@endsection
