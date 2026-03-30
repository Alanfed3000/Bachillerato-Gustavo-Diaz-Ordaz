<div id="create-docente-modal" class="modal">
    <div class="modal-content">
        <h2 style="color: #28a745;">➕ Registrar Nuevo Docente</h2>

        <form action="{{ route('docentes.store') }}" method="POST">
            @csrf
            {{-- Incluimos el form.blade.php sin pasarle un docente (creación) --}}
            @include('cpanel.docentes.form', ['docente' => null])
        </form>
    </div>
</div>
