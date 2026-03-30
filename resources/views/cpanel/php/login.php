<?php
// login.php
require_once("config.php"); // Conexión a la base de datos

$conexion = new DBMysql();
session_start();

if ($conexion->getConexion()) {

    if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {

        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        // Consulta para obtener la contraseña en texto plano
        $consulta = $conexion->prepare("SELECT contrasena_hash FROM estudiantes WHERE usuario=?");
        $consulta->bind_param("s", $usuario);
        $consulta->execute();
        $consulta->bind_result($hash);
        $consulta->fetch();
        $consulta->close();

        // Verificación directa
        if ($hash && $contrasena === $hash) {
            $_SESSION['usuario'] = $usuario;
            header("Location: dashboard.php"); // Página después de login
            exit;
        } else {
            $error = "Usuario o contraseña incorrectos";
        }

    }

} else {
    $error = "Error de conexión con la base de datos";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bachillerato Gustavo Díaz Ordaz</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body{
            min-height: 100vh;
            background: url('../logo/Patio2.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }
        header{
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 15px 50px;
            background: rgba(95,0,0,0.9);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 99;
        }
        header .logo {
            color: #fff;
            font-size: 1.5em;
            display: flex;
            align-items: center;
        }
        header .logo img {
            height: 50px;
            margin-right: 10px;
        }
        .navigation a, .btnLogin-popup {
            color: #fff;
            margin-left: 30px;
            text-decoration: none;
            font-weight: 500;
        }
        .btnLogin-popup {
            border: 2px solid #fff;
            border-radius: 6px;
            padding: 5px 15px;
            cursor: pointer;
            background: transparent;
        }
        .btnLogin-popup:hover {
            background: #fff;
            color: #520c0c;
        }
        /* Formulario oculto inicialmente */
        .login-card {
            display: none;
            background: rgba(255,255,255,0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,.5);
            width: 350px;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 100;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../logo/logo.png" alt="Logo">
            Bachillerato Gustavo Díaz Ordaz
        </div>
        <nav class="navigation">
            <a href="#">Misión</a>
            <a href="#">Visión</a>
            <button class="btnLogin-popup" onclick="mostrarLogin()">Iniciar Sesión</button>
        </nav>
    </header>

    <!-- Formulario de login -->
    <div class="login-card" id="login-card">
        <h3 class="text-center mb-4">Iniciar Sesión</h3>
        <?php if(isset($error)) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="recordarme">
                <label class="form-check-label" for="recordarme">Recordarme</label>
            </div>
            <button type="submit" class="btn btn-danger w-100">Iniciar Sesión</button>
            <button type="button" class="btn btn-secondary w-100 mt-2" onclick="ocultarLogin()">Cerrar</button>
        </form>
    </div>

    <script>
        function mostrarLogin() {
            document.getElementById('login-card').style.display = 'block';
        }
        function ocultarLogin() {
            document.getElementById('login-card').style.display = 'none';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
