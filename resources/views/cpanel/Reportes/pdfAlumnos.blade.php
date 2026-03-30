<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Alumnos - ADROA</title>
    <style>
        body { font-family: sans-serif; font-size: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; table-layout: fixed; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; word-wrap: break-word; }
        th { background-color: #f2f2f2; font-weight: bold; text-align: center; }
        .header { text-align: center; margin-bottom: 20px; }
        .footer { position: fixed; bottom: -30px; width: 100%; text-align: right; font-size: 8px; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
<div class="footer">Sistema ADROA | Generado el: {{ date('d/m/Y H:i:s') }}</div>

<div class="header">
    <h1 style="margin-bottom: 5px;">Bachillerato General Oficial "Gustavo Díaz Ordaz"</h1>
    <h2 style="margin-top: 0; color: #444;">Directorio General de Estudiantes</h2>
</div>

<table>
    <thead>
    <tr>
        <th style="width: 5%;">ID</th>
        <th style="width: 25%;">Nombre Completo</th>
        <th style="width: 18%;">CURP</th>
        <th style="width: 12%;">Teléfono</th>
        <th style="width: 15%;">Ciudad</th>
        <th style="width: 25%;">Dirección (Calle y No.)</th>
    </tr>
    </thead>
    <tbody>
    @foreach($alumnos as $alumno)
        <tr>
            <td class="text-center">{{ $alumno->id_estudiante }}</td>
            <td>{{ $alumno->nombre }} {{ $alumno->apellido_p }} {{ $alumno->apellido_m }}</td>
            <td>{{ $alumno->curp }}</td>
            <td class="text-center">{{ $alumno->no_telefono }}</td>
            <td>{{ $alumno->ciudad }}</td>
            <td>{{ $alumno->calle }} #{{ $alumno->numero }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
