<?php
session_start();
require_once("config.php"); // Conexión a la base de datos
$conexion = new DBMysql();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Obtener información del estudiante
$usuario = $_SESSION['usuario'];
$consulta = $conexion->prepare("SELECT nombre, apellido_paterno, apellido_materno, fecha_nacimiento, sexo, curp, telefono, correo, nia, grado, grupo FROM estudiantes WHERE usuario = ?");
$consulta->bind_param("s", $usuario);
$consulta->execute();
$resultado = $consulta->get_result();
$estudiante = $resultado->fetch_assoc();
$consulta->close();

// Nombre completo
$nombreCompleto = $estudiante['nombre'] . ' ' . $estudiante['apellido_paterno'] . ' ' . $estudiante['apellido_materno'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card-header-custom {
            background-color: #5f0000;
            color: white;
        }
        .section-title {
            margin-top: 30px;
            margin-bottom: 15px;
            font-weight: bold;
            color: #5f0000;
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="#">Control Escolar</a>
    <div class="ms-auto">
        <span class="text-white me-3">
            Bienvenido, <?php echo $estudiante['nombre']; ?>
        </span>
        <a href="logout.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-5">

    <h2 class="mb-4">Panel del Estudiante</h2>

    <!-- Información personal -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header card-header-custom">
            Información Personal
        </div>
        <div class="card-body">
            <p><strong>Nombre completo:</strong> <?php echo $nombreCompleto; ?></p>
            <p><strong>Fecha de nacimiento:</strong> <?php echo $estudiante['fecha_nacimiento']; ?></p>
            <p><strong>Teléfono:</strong> <?php echo $estudiante['telefono']; ?></p>
            <p><strong>Correo:</strong> <?php echo $estudiante['correo']; ?></p>
        </div>
    </div>

    <!-- Información escolar -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header card-header-custom">
            Información Escolar
        </div>
        <div class="card-body">
            <p><strong>NIA:</strong> <?php echo $estudiante['nia']; ?></p>
            <p><strong>Grado:</strong> <?php echo $estudiante['grado']; ?></p>
            <p><strong>Grupo:</strong> <?php echo $estudiante['grupo']; ?></p>
        </div>
    </div>

    <!-- Calificaciones (vacío) -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header card-header-custom">
            Calificaciones
        </div>
        <div class="card-body">
            <p>Aún no hay calificaciones registradas.</p>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
