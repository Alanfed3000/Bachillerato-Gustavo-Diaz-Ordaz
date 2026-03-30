<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login | Bachillerato Gustavo Díaz Ordaz</title>
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <style>
        .login-container {
            height: 100vh;
            width: 100%; /* Asegura que ocupe todo el ancho */
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f4f7f6;
        }        .login-card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 350px; text-align: center; }
        .login-card h2 { color: #2e7d32; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; text-align: left; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .btn-login { width: 100%; padding: 10px; background: #2e7d32; color: white; border: none; border-radius: 5px; cursor: pointer; }
        .error-msg { color: red; font-size: 13px; margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <h2>Iniciar Sesión</h2>

        @if($errors->any())
            <div class="error-msg">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Correo Electrónico:</label>
                <input type="email" name="email" required placeholder="ejemplo@correo.com">
            </div>
            <div class="form-group">
                <label>Contraseña:</label>
                <input type="password" name="password" required placeholder="********">
            </div>
            <button type="submit" class="btn-login">Entrar</button>
        </form>
    </div>
</div>
</body>
</html>
