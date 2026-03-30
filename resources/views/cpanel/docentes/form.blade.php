<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
    <div>
        <label style="display: block; font-weight: bold;">Nombre(s):</label>
        <input type="text" name="nombre" value="{{ old('nombre', $docente->nombre ?? '') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div>
        <label style="display: block; font-weight: bold;">Apellido Paterno:</label>
        <input type="text" name="apellido_p" value="{{ old('apellido_p', $docente->apellido_p ?? '') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div>
        <label style="display: block; font-weight: bold;">Apellido Materno:</label>
        <input type="text" name="apellido_m" value="{{ old('apellido_m', $docente->apellido_m ?? '') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div>
        <label style="display: block; font-weight: bold;">CURP:</label>
        <input type="text" name="curp" value="{{ old('curp', $docente->curp ?? '') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div>
        <label style="display: block; font-weight: bold;">RFC:</label>
        <input type="text" name="rfc" value="{{ old('rfc', $docente->rfc ?? '') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
    <div>
        <label style="display: block; font-weight: bold;">Estudios / Área:</label>
        <input type="text" name="estudios" value="{{ old('estudios', $docente->estudios ?? '') }}" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
    </div>
</div>

<div style="display: flex; gap: 10px; justify-content: center; margin-top: 20px;">
    <button type="submit" class="btn btn-primary" style="padding: 10px 20px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">💾 Guardar Información</button>

    {{-- BOTON DE CANCELAR --}}
    <a href="{{ route('docentes.index') }}" class="btn btn-cancel" style="padding: 10px 20px; background: #6c757d; color: white; border: none; border-radius: 4px; text-decoration: none; display: inline-block;">
        Cancelar
    </a>
</div>
