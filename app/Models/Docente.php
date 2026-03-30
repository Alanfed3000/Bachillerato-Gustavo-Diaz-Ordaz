<?php

// app/Models/Docente.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    // Forzamos el nombre exacto de la tabla y la llave primaria
    protected $table = 'docentes';
    protected $primaryKey = 'id_docente';

    protected $fillable = [
        'nombre', 'apellido_p', 'apellido_m',
        'curp', 'rfc', 'telefono',
        'estudios', 'num_cedula_prof'
    ];
}
