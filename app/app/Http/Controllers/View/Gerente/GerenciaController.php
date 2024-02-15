<?php

namespace App\Http\Controllers\View\Gerente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GerenciaController extends Controller
{
    public function show()
    {
        return view('Gerente.index');
    }
}
