<!DOCTYPE html>
<html>
<head>
    <style>
        .card {
            font-family: Arial, sans-serif;
            border: 1px solid #ddd;
            padding: 20px;
            max-width: 500px;
            margin: auto;
            border-radius: 8px;
        }
        .header { color: #2e7d32; text-align: center; }
        .code {
            display: block;
            font-size: 32px;
            font-weight: bold;
            color: #333;
            text-align: center;
            letter-spacing: 5px;
            margin: 20px 0;
            background: #f4f7f6;
            padding: 10px;
        }
        .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
<div class="card">
    <h2 class="header">🔐 Código de Verificación</h2>
    <p>Hola,</p>
    <p>Has intentado acceder al panel del <strong>Bachillerato Gustavo Díaz Ordaz</strong>. Tu código de seguridad de 6 dígitos es:</p>

    <span class="code">{{ $code }}</span>

    <p>Este código expirará en 15 minutos por tu seguridad.</p>
    <p>Si tú no solicitaste este acceso, por favor ignora este correo.</p>

    <div class="footer">
        © {{ date('Y') }} Sistema de Control Escolar - Bachillerato
    </div>
</div>
</body>
</html>
