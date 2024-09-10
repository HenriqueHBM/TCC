<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutosImagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class CriarDistribuicaoController extends Controller
{

    public function enviar_distribuicao()
    {


        return view("enviar_distribuicao");
    }


    public function save_distribuicao(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'produto_nome' => 'required',
            'preco' => 'required|numeric',
            'imagem' => 'required',
            'quantidade' => 'required|numeric',
            'data_vencimento' => 'required',
            'descricao' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::json(array('error' => $validator->getMessageBag()->toArray()));
        } else {

            $produto = new Produto();
            $produto->produto = $r->produto_nome;
            $produto->preco = $r->preco;
            $produto->qtde = $r->quantidade;
            $produto->data_vencimento = $r->data_vencimento;
            $produto->descricao = $r->descricao;
            
            
            $produto->save();


        return view('enviar_distribuicao');
    }
}
}
