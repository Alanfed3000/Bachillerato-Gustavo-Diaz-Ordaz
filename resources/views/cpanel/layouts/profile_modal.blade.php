<div id="profile-modal" class="modal">
    <div class="modal-content">
        <h2>✏️ Editar Perfil de Usuario</h2>

        <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="profile-name">Nombre Completo:</label>
                <input type="text" id="profile-name" name="name" value="{{ auth()->user()->name ?? 'Usuario' }}" required>
            </div>

            <div class="form-group">
                <label for="profile-email">Correo Electrónico:</label>
                <input type="email" id="profile-email" value="{{ auth()->user()->email }}" disabled>
                <small style="color: gray;">El correo no se puede cambiar.</small>
            </div>

            <div class="form-group">
                <label for="profile-matricula">Matrícula/ID:</label>
                <input type="text" id="profile-matricula" name="matricula" value="{{ auth()->user()->matricula }}">
            </div>

            <div class="form-group">
                <label for="profile-phone">Teléfono de Contacto:</label>
                <input type="text" id="profile-phone" name="telefono" value="{{ auth()->user()->telefono }}">
            </div>

            <div class="form-group">
                <label for="profile-photo">Foto de Perfil:</label>
                <input type="file" id="profile-photo" name="foto" accept="image/*">
                @if(auth()->user()->foto)
                    <div style="margin-top: 10px;">
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto actual" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                    </div>
                @endif
            </div>

            <div class="modal-actions" style="margin-top: 20px; display: flex; gap: 10px;">
                <button type="button" class="btn btn-cancel" id="close-profile-modal" style="flex: 1; padding: 10px; cursor: pointer;">Cancelar</button>
                <button type="submit" class="btn btn-save" style="flex: 1; background-color: #2e7d32; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; font-weight: bold;">
                    Guardar Cambios
                </button>
            </div>
        </form>

        <hr style="margin: 25px 0; border: 0; border-top: 1px solid #eee;">

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" style="background-color: #d32f2f; color: white; border: none; padding: 12px; border-radius: 8px; cursor: pointer; width: 100%; font-weight: bold; display: flex; align-items: center; justify-content: center; gap: 8px;">
                <span>🚪</span> Cerrar Sesión Segura
            </button>
        </form>
    </div>
</div>
