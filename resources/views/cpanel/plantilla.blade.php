<!DOCTYPE html>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Plataforma Bachillerato')</title>

    {{-- Asegúrate de que esta ruta sea correcta para el CSS de la sección 1 --}}
    <link rel="stylesheet" href="/css/css.css">

    @yield('styles')

    {{-- CRÍTICO: Inclusión de Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


</head>
<body>

@include('cpanel.layouts.sidebar')

<div class="content-wrapper" id="content-wrapper">

    @include('cpanel.layouts.header')

    <main class="main-content">
        @yield('content')
    </main>


</div>

@include('cpanel.layouts.profile_modal')

{{-- Inclusión del nuevo modal de DOCENTE --}}
@include('cpanel.docentes.createdocentes')

{{-- Asegúrate de que esta ruta sea correcta para el JS de la sección 2 --}}

<script src="/css/JavaS.js" defer></script>

@stack('scripts') {{-- Aquí se insertará el código de Chart.js de la vista dashboard.blade.php --}}

</body>
</html>
