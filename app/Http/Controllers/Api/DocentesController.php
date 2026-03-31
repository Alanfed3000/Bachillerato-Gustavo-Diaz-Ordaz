<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Docente; // Asegúrate de que el modelo exista

class DocentesController extends Controller
{
    public function index()
    {
        return Carrera::all();
    }
}
