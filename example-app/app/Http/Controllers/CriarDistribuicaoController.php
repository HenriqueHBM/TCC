<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CriarDistribuicaoController extends Controller
{
    public function criar_distribuicao()
    {
        return view('criar_distribuicao');
    }
}
