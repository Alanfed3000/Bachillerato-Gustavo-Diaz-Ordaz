<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;

    protected $fillable = [
        'materia_id',    // La relación con la tabla materias
        'titulo',
        'descripcion',
        'fecha_entrega',
    ];

    /**
     * Relación: Una tarea pertenece a una materia.
     * Esto te servirá para mostrar el nombre de la materia en la tabla.
     */
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}
