<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "pruebas");

if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

// Obtener usuario y contraseña del formulario
$usuario = $_POST['user'] ?? '';
$password = $_POST['password'] ?? '';

// Buscar usuario en la base de datos
$stmt = $conexion->prepare("SELECT usuario, contrasena_hash FROM estudiantes WHERE usuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $datos = $resultado->fetch_assoc();

    // Verificar la contraseña
    if (password_verify($password, $datos['contrasena_hash'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: panel_estudiante.php");
        exit();
    } else {
        echo "<script>alert('❌ Contraseña incorrecta'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('❌ Usuario no encontrado'); window.history.back();</script>";
}

$stmt->close();
$conexion->close();
?>
