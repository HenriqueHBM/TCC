<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MinhasEntregasController extends Controller
{
    public function minhas_entregas()
    {
        return view('minhas_entregas');
    }
}
