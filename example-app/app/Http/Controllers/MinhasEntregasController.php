<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProdutosImagem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MinhasEntregasController extends Controller
{
    public function minhas_entregas()
    {
        $produtos = Produto::where('id_usuario', Auth::user()->id)->get();
        return view('minhas_entregas', compact('produtos'));
    }

    public function excluir(Request $r){
        $produto = Produto::findOrFail($r->id);
        $produto->delete();
    }

    public function editar($id){
        $produto = Produto::findOrFail($id);
        return view('produtos.editar', compact('produto'));
    }

    public function save_editar(Request $r, $id){
        $validator = Validator::make($r->all(), [
            'produto' => 'required',
            'preco' => 'required',
            'qtde' => 'required',
            'dt_vencimento' => 'required',
            'show_img.*' => 'required|mimes:png,jpg,jpeg,avif,webp|max:2048'
        ]);

        if($validator->fails()){
            return Response::json(array('error' => $validator->getMessageBag()->toArray()));
        }else{
            $produto = Produto::findOrFail($id);
            $produto->produto = $r->produto;
            $produto->preco = $r->preco;
            $produto->qtde = $r->qtde;
            $produto->data_vencimento = $r->dt_vencimento;
            $produto->descricao = $r->descricao;
            $produto->update();

            if($r->show_img){
                $old_img = ProdutosImagem::where('id_produto', $id)->get();
                foreach($old_img as $img){
                    Storage::disk('public')->delete('img_produtos_users/'.$img->imagem);

                }
                $imagem = ProdutosImagem::where('id_produto', $id)->delete();



                $x = 0;
                foreach($r->show_img as $img){
                    $new_img = new ProdutosImagem();
                    $new_img->id_produto = $id;
    
                    $uniq = uniqid();
                    $nomeArquivo = 'ID'. $r->show_img[$x]->getClientOriginalName(). $uniq.'.'.$r->show_img[$x]->getClientOriginalExtension();
                    Storage::disk('public')->put('img_produtos_users/'.$nomeArquivo, file_get_contents($r->show_img[$x]));
                    $new_img->imagem = $nomeArquivo;
    
                    // $new_img->imagem = $r->show_img[$x];
                    $new_img->created_at = Carbon::now();
                    $new_img->save();
    
                    $x++;
                }

            }
        }
    }
}
