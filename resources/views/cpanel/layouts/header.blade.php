<header class="main-header">
    <div class="header-left">
        <button class="menu-toggle" aria-label="Abrir Menú">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <h1 class="page-title">Bachillerato General Oficial "Gustavo Díaz Ordaz"</h1>
    </div>

    <div class="user-icon" id="open-profile-modal" title="Editar Perfil">
        @if(auth()->check() && auth()->user()->foto)
            {{-- Mostramos la foto si existe en la base de datos --}}
            <img src="{{ asset('storage/' . auth()->user()->foto) }}"
                 alt="Perfil"
                 style="width: 100%; height: 100%; border-radius: 50%; object-fit: cover; display: block;">
        @else
            {{-- Si no hay foto o no está logueado, mostramos la inicial del nombre --}}
            {{ auth()->check() ? strtoupper(substr(auth()->user()->name, 0, 1)) : '?' }}
        @endif
    </div>
</header>
