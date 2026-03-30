<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificación de Seguridad | Bachillerato</title>
    <link rel="stylesheet" href="{{ asset('css/css.css') }}">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .verify-container {
            min-height: 100vh;
            width: 100%; /* Importante para el centrado total */
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f7f6;
        }
        .verify-card {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            text-align: center;
            width: 90%;
            max-width: 400px;
        }
        .verify-card h2 {
            color: #2e7d32; /* Verde institucional */
            margin-bottom: 1rem;
        }
        .verify-card p {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
        }
        .code-input {
            letter-spacing: 12px; /* Más espacio entre números */
            font-size: 28px;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            box-sizing: border-box; /* Evita que se salga de la tarjeta */
            margin: 25px 0;
            transition: border-color 0.3s;
            outline: none;
        }
        .code-input:focus {
            border-color: #2e7d32;
            background-color: #f1f8e9;
        }
        .btn-verify {
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 14px 25px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            font-size: 16px;
            transition: background 0.3s;
        }
        .btn-verify:hover {
            background-color: #1b5e20;
        }
        .cancel-link {
            display: inline-block;
            margin-top: 20px;
            color: #888;
            text-decoration: none;
            font-size: 0.9rem;
            background: none;
            border: none;
            cursor: pointer;
        }
        .cancel-link:hover {
            color: #d32f2f;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="verify-container">
    <div class="verify-card">
        <h2>🔐 Verificación de Seguridad</h2>
        <p>Por favor, ingresa el código de <strong>6 dígitos</strong> enviado a tu correo para confirmar tu identidad.</p>

        <form action="{{ route('verify.store') }}" method="POST">
            @csrf
            <input type="text"
                   name="two_factor_code"
                   class="code-input"
                   maxlength="6"
                   placeholder="000000"
                   pattern="\d*"
                   inputmode="numeric"
                   autocomplete="one-time-code"
                   required
                   autofocus>
            <button type="submit" class="btn-verify">Verificar Acceso</button>
        </form>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="cancel-link">Cancelar inicio de sesión</button>
        </form>
    </div>
</div>
</body>
</html>
