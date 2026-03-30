<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    protected $table = 'Estudiante';
    protected $primaryKey = 'id_estudiante';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'apellido_p',
        'apellido_m',
        'curp',
        'sexo',
        'fecha_nac',
        'no_telefono',
        'ciudad',
        'calle',
        'numero',
    ];
}
