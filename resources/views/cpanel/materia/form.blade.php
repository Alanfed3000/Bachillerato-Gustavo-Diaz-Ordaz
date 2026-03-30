<div class="form-group" style="margin-bottom: 15px;">
    <label>Nombre de la Asignatura:</label>
    <input type="text" name="nombre" value="{{ old('nombre', $materia->nombre ?? '') }}" class="form-control" required>
</div>

<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
    <div>
        <label>Número de Horas:</label>
        <input type="number" name="no_horas" value="{{ old('no_horas', $materia->no_horas ?? '') }}" class="form-control">
    </div>
    <div>
        <label>Créditos:</label>
        <input type="number" name="creditos" value="{{ old('creditos', $materia->creditos ?? '') }}" class="form-control">
    </div>
</div>

<div class="form-group" style="margin-top: 15px;">
    <label>Área de Formación:</label>
    <input type="text" name="area_formacion" value="{{ old('area_formacion', $materia->area_formacion ?? '') }}" class="form-control">
</div>

<div style="display: flex; gap: 10px; margin-top: 20px;">
    <button type="submit" class="btn btn-primary" style="background: #4e73df; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
        💾 Guardar Información
    </button>
    <a href="{{ route('materias.index') }}" class="btn btn-secondary" style="text-decoration: none; padding: 10px 20px; background: #858796; color: white; border-radius: 5px;">
        Cancelar
    </a>
</div>
