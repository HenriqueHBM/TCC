<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cep;
use App\Models\Endereco;
use App\Models\Evento;
use App\Models\ProdutosEvento;
use App\Models\ProdutosImagem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MeusEventosController extends Controller
{
    public function meus_eventos()
    {
        $meus_eventos = Evento::where('id_usuario', Auth::user()->id)->get();
        return view('meus_eventos', compact('meus_eventos'));
        
    }
    public function excluir(Request $r){
        $meus_eventos = Evento::findOrFail($r->id);
        $meus_eventos->delete();
    }

    public function editar_evento($id)
    {
        $produtos = null;
        $meu_evento = Evento::findOrFail($id);
        $ceps = Cep::get();

        if(isset(Auth::user()->id)) {
            $produtos = Produto::where("id_usuario", Auth::user()->id)
            ->where('qtde', '>', 0 )->get();
        }

        return view('eventos.editar_evento', compact('meu_evento', 'ceps', 'produtos'));
    }

    public function save_editar(Request $r, $id){
        $validator = Validator::make($r->all(),[
            'titulo' => 'required',
            'data' => 'required',
            'hora_ini' => 'required',
            'hora_fim' => 'required',
            'cep' => 'required',
            'num_local' => 'required',
            'rua' => 'required',
            'bairro' => 'required', 
            'show_img' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        if($validator->fails()){
            return Response::json(array( 'error' =>$validator->getMessageBag()->toArray()));
        }else{

            $evento = Evento::findOrFail($id);
            $evento->data = $r->data;
            $evento->horario_inicio = $r->hora_ini;
            $evento->horario_fim = $r->hora_fim;
            $evento->descricao = $r->descricao;
            if(isset($r->show_img) && $r->img_editado){
                // variavel que recebe valor unico
                $uniq = uniqid();

                // criando um nome para o arquivo, pegando o nome do arquivo, adicionando valor unico e a extenxao original do arquivo
                $nomeArquivo = 'ID'. $r->show_img->getClientOriginalName(). $uniq.'.'.$r->show_img->getClientOriginalExtension();
                Storage::disk('public')->put('banners_eventos/'.$nomeArquivo, file_get_contents($r->show_img));
                $evento->imagem = $nomeArquivo;
            }

            $evento->titulo_evento = $r->titulo;
            $evento->update();


            $endereco = Endereco::findOrFail($evento->id_endereco);
            $endereco->rua = $r->rua;
            $endereco->numero_residencia = $r->num_local;
            $endereco->id_cep = $r->cep;
            $endereco->bairro = $r->bairro;
            $endereco->update();

            if(isset($r->produtos) &&  $r->produtos !=  'Nenhum produto Selecionado'){
                foreach ($r->produtos as $produto) {
                    $prod_evento = new ProdutosEvento();
                    $prod_evento->id_produto = $produto;
                    $prod_evento->id_evento = $evento->id_evento;
                    $prod_evento->save();
                }
            }

            if(!empty($r->old_prod)){
                $produtos = ProdutosEvento::where('id_evento', $evento->id_evento)->get();

                
            }
        }
    }

    public function remover_prod_evento(Request $r){
        $prod_eve = ProdutosEvento::findOrFail($r->id);
        $prod_eve->delete();
    }
}