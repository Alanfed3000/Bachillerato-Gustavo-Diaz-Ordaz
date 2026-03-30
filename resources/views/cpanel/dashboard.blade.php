@extends('cpanel.plantilla')

@section('title', 'Dashboard - Resumen')

@section('content')

    <section class="content-section active">
        <h1>Dashboard del Bachillerato 📊</h1>
        <p>Vista general y estadísticas clave del sistema.</p>

        {{-- SECCIÓN DE TARJETAS DE INDICADORES --}}
        <div style="display: flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap;">
            <div class="module-card" style="flex: 1; min-width: 200px; padding: 20px; border-left: 5px solid #4e73df; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 0.8rem; font-weight: bold; color: #4e73df; text-transform: uppercase;">Total Alumnos</div>
                    <div style="font-size: 1.5rem; font-weight: bold; color: #5a5c69;">{{ $totalAlumnos }}</div>
                </div>
                <div style="font-size: 2rem; color: #dddfeb;">🎓</div>
            </div>

            <div class="module-card" style="flex: 1; min-width: 200px; padding: 20px; border-left: 5px solid #1cc88a; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 0.8rem; font-weight: bold; color: #1cc88a; text-transform: uppercase;">Docentes Activos</div>
                    <div style="font-size: 1.5rem; font-weight: bold; color: #5a5c69;">{{ $totalDocentes }}</div>
                </div>
                <div style="font-size: 2rem; color: #dddfeb;">👨‍🏫</div>
            </div>

            <div class="module-card" style="flex: 1; min-width: 200px; padding: 20px; border-left: 5px solid #f6c23e; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <div style="font-size: 0.8rem; font-weight: bold; color: #f6c23e; text-transform: uppercase;">Promedio Grupal</div>
                    <div style="font-size: 1.5rem; font-weight: bold; color: #5a5c69;">{{ number_format($promedioGeneral, 1) }}</div>
                </div>
                <div style="font-size: 2rem; color: #dddfeb;">📈</div>
            </div>
        </div>

        {{-- SECCIÓN DE LA GRÁFICA EXISTENTE --}}
        <div class="module-card" style="padding: 20px;">
            <h3>Docentes por Nivel de Estudios / Área</h3>
            <p>La gráfica de barras muestra la cantidad de docentes según su formación profesional registrada.</p>

            <div style="max-width: 900px; margin: 20px auto;">
                <canvas id="docentesChart"></canvas>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // 1. Usar DOMContentLoaded para asegurar que el canvas ya existe en el HTML
            document.addEventListener('DOMContentLoaded', function() {
                const etiquetas = @json($materias);
                const conteos = @json($conteos);

                const ctx = document.getElementById('docentesChart');

                if (ctx) {
                    new Chart(ctx.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: etiquetas,
                            datasets: [{
                                label: 'Cantidad de Docentes',
                                data: conteos,
                                backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e', '#36b9cc'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: { precision: 0 }
                                }
                            }
                        }
                    });
                } else {
                    console.error("No se encontró el elemento canvas con id 'docentesChart'");
                }
            });
        </script>
    @endpush
@endsection
