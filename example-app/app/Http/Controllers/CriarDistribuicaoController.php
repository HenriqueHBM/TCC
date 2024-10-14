<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutosImagem;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'preco' => 'required|numeric',
            'quantidade' => 'required|numeric',
            'data_vencimento' => 'required',
            'descricao' => 'required',
        ]);

        if ($validator->fails()) {
            return Response::json(array('error' => $validator->getMessageBag()->toArray()));
        } else {

            $produto = new Produto();
            $produto->produto = $r->produto_nome;
            $produto->codigo = uniqid();
            $produto->preco = $r->preco;
            $produto->qtde = $r->quantidade;
            $produto->data_vencimento = $r->data_vencimento;
            $produto->descricao = $r->descricao;
            $produto->id_categoria = 3;

            $produto->id_usuario = Auth::user()->id;

            
            $produto->save();

            

            $x = 0;
                foreach($r->imagem as $img){
                    $new_img = new ProdutosImagem();
                    $new_img->id_produto = $produto->id_produto;
                    

                    if(isset($r->imagem[$x])){
                        // variavel que recebe valor unico
                        $uniq = uniqid();
        
                        // criando um nome para o arquivo, pegando o nome do arquivo, adicionando valor unico e a extenxao original do arquivo
                        $nomeArquivo = 'ID'. $r->imagem[$x]->getClientOriginalName(). $uniq.'.'.$r->imagem[$x]->getClientOriginalExtension();
                        Storage::disk('public')->put('img_produtos_users/'.$nomeArquivo, file_get_contents($r->imagem[$x]));
                        $produto->imagem = $nomeArquivo;
                    }else{
                        $produto->imagem = 'default_banner.jpeg';
                    }
                    $new_img->imagem = $nomeArquivo;
    
                    // $new_img->imagem = $r->show_img[$x];
                    $new_img->created_at = Carbon::now();
                    $new_img->save();
    
                    $x++;
                }

                return redirect()->route('home');
    }
}
}
