<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    use HasFactory;

    protected $table = 'semestre'; // Verifica si en tu DB es 'semestre' o 'Semestre'
    protected $primaryKey = 'id_semestre';
    public $timestamps = false;

    protected $fillable = ['id_semestre', 'dia', 'mes', 'anio'];
}
