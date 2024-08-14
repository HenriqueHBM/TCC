<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CriarDistribuicaoController extends Controller
{
    public function criar_distribuicao()
    {
        $validator = Validator::make($r->all(), [
            'titulo' => 'required',
            'data' => 'required',
            'hora_ini' => 'required',
            'hora_fim' => 'required',
            'cep' => 'required|numeric',
            'num_local' => 'required',
            'rua' => 'required',
            'bairro' => 'required',
            'imagem' => 'mimes:png,jpg,jpeg|max:2048'
        ]);


        return view('criar_distribuicao');
    }
}
