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

    public function criar_distribuicao()
    {


        return view("criar_distribuicao");
    }


    public function save_distribuicao(Request $r)
    {
        $validator = Validator::make($r->all(), [
            'produto_nome' => 'required',
            'preco' => 'required|float',
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
            if(isset($r->imagem)){
                // variavel que recebe valor unico
                $uniq = uniqid();

                // criando um nome para o arquivo, pegando o nome do arquivo, adicionando valor unico e a extenxao original do arquivo
                $nomeArquivo = 'ID'. $r->imagem->getClientOriginalName(). $uniq.'.'.$r->imagem->getClientOriginalExtension();
                Storage::disk('public')->put('banners_eventos/'.$nomeArquivo, file_get_contents($r->imagem));
                $produto->imagem = $nomeArquivo;
            }else{
                $produto->imagem = 'default_banner.jpeg';
            }
            if($r->produto_imagem){
                foreach ($r->produtos as $produto) {
                    $produto_imagem = new ProdutosImagem();
                    $produto_imagem->id_produto_imagem = $produto_imagem;
                    $produto_imagem->id_produto = $produto->id_produto;
                    $produto_imagem->save();
                }
            }
            
            $produto->save();


        return view('criar_distribuicao');
    }
}
}
