<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DistribuicoesController extends Controller
{
    public function distribuicoes()
    {
        return view('distribuicoes');
    }
}
