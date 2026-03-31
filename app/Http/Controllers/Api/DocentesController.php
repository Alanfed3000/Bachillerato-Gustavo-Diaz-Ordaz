<?php

namespace App\Http\Controllers\Api;

use App\Models\Docente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocentesController extends Controller
{
    public function index()
    {
        return Docente::all();
    }
}
