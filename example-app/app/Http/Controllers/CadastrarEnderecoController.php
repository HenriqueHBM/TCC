<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cep;
use App\Models\Endereco;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CadastrarEnderecoController extends Controller
{
    public function cadastrar_endereco()
    {

        $ceps = Cep::get();

        return view("cadastrar_endereco", compact("ceps"));
    }
    public function save_register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cep' => 'required',
            'num_residencia' => 'requred',
            'rua' => 'required',
            'bairro' => 'required'
        ]);

        if ($validator->fails()) {
            return Response::json([array('error' => $request->getMessageBah()->toArray())]);
        
        }
            $dados = new Endereco();
            $dados->id_cep = $request->cep;
            $dados->rua = $request->rua;
            $dados->bairro = $request->bairro;
            $dados->complemento = $request->complemento;
            $dados->save();

        
    }
}
