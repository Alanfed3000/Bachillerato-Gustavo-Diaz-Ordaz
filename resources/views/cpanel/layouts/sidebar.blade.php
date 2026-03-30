<nav class="sidebar" id="sidebar">
    <header class="sidebar-header">
        <div class="logo-text">BACHILLERATO<br>GUSTAVO DÍAZ ORDAZ</div>
    </header>
    <ul class="nav-links">
        <li><a href="{{ route('dashboard') }}" class="nav-link-item {{ request()->is('admon/dashboard*') ? 'active' : '' }}">Dashboard</a></li>
        <li><a href="{{ route('contenidos') }}" class="nav-link-item {{ request()->is('admon/contenidos*') ? 'active' : '' }}">Contenidos</a></li>
        <li><a href="{{ route('docentes.index') }}" class="nav-link-item {{ request()->is('admon/docentes*') ? 'active' : '' }}">Docentes</a></li>
        <li><a href="{{ route('alumnos.index') }}" class="nav-link-item {{ request()->is('admon/alumnos*') ? 'active' : '' }}">Alumnos</a></li>
        <li><a href="{{ route('materias.index') }}" class="nav-link-item {{ request()->is('admon/materias*') ? 'active' : '' }}">Materias</a></li>
        <li><a href="{{ route('horario.index') }}" class="nav-link-item {{ request()->is('admon/horario*') ? 'active' : '' }}">Horario</a></li>
        <li><a href="{{ route('tareas.index') }}" class="nav-link-item {{ request()->is('admon/tareas*') ? 'active' : '' }}">Tareas</a></li>
    </ul>
    <footer class="sidebar-footer">
        <div class="info-icon">i</div>
    </footer>
</nav>
