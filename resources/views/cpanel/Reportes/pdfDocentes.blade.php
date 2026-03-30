<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Docentes</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
    </style>
</head>
<body>
<div class="header">
    <h1>Bachillerato General Oficial "Gustavo Díaz Ordaz"</h1>
    <h2>Reporte General de Docentes</h2>
</div>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre Completo</th>
        <th>CURP / RFC</th>
        <th>Estudios / Área</th>
    </tr>
    </thead>
    <tbody>
    @foreach($docentes as $docente)
        <tr>
            <td>{{ $docente->id_docente }}</td>
            <td>{{ $docente->nombre }} {{ $docente->apellido_p }} {{ $docente->apellido_m }}</td>
            <td>
                <strong>C:</strong> {{ $docente->curp }} <br>
                <strong>R:</strong> {{ $docente->rfc }}
            </td>
            <td>{{ $docente->estudios }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
