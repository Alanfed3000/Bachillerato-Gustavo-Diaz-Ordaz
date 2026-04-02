<?php

namespace App\Http\Controllers\Api;

use App\Models\Docente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocentesController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        return response()->json($docentes);
    }
}
