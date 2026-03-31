<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocentesController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\HorariosController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Api\DocentesController;

// ------------------------------------------------------------------
// 1. RUTAS PÚBLICAS (Sin protección)
// ------------------------------------------------------------------
// El formulario de login DEBE ser accesible para todos.
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/carreras', [DocentesController::class, 'index']);


// ------------------------------------------------------------------
// 2. RUTAS QUE REQUIEREN LOGIN PERO NO EL 2FA TODAVÍA
// ------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {

    // Aquí es donde el usuario llega para poner su código de 6 dígitos
    Route::get('verify', [LoginController::class, 'showVerifyForm'])->name('verify.index');
    Route::post('/verify', [LoginController::class, 'verifyCode'])->name('verify.store');
});


// ------------------------------------------------------------------
// 3. RUTAS PROTEGIDAS (Requieren Login Y Código de 2FA)
// ------------------------------------------------------------------
Route::middleware(['auth', 'verified2fa'])->prefix('admon')->group(function () {

    Route::get('/', [DashboardController::class, 'mostrarDashboard'])->name('dashboard');

    Route::get('/contenidos', function () {
        return view('cpanel.inicio');
    })->name('contenidos');

    Route::get('docentes/exportar', [DocentesController::class, 'exportarExcel'])->name('docentes.exportar');
    Route::resource('docentes', DocentesController::class);
    Route::resource('materias', MateriasController::class);
    Route::resource('tareas', TareasController::class);
    Route::resource('alumnos', EstudianteController::class);
    Route::resource('horario', HorariosController::class);

    // Ruta de perfil
    Route::put('/perfil/update', [PerfilController::class, 'update'])->name('perfil.update');

    // Reportes
    Route::get('reportes/pdfDocentes', [ReportesController::class, 'GenerarPDF'])->name('reportes.pdf');

    Route::get('Reportes/reporte-pdf', [EstudianteController::class, 'generarPDF'])->name('alumnos.pdf');
    Route::resource('alumnos', EstudianteController::class);

});
