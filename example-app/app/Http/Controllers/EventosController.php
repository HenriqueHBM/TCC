<?php

namespace App\Http\Controllers;

use App\Models\Cep;
use App\Models\Endereco;
use App\Models\Evento;
use App\Models\Produto;
use App\Models\ProdutosEvento;
use App\Models\Termo;
use App\Models\TermosAssinado;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class EventosController extends Controller
{
    public function enventos()
    {
        $produtos = null;
        $ceps = Cep::get();
        $eventos = Evento::get();
        $termo = Termo::where('termo', 'Termo de Responsabilidade para Cadastro de Evento')->first();

        if(isset(Auth::user()->id)) {
            $produtos = Produto::where("id_usuario", Auth::user()->id)->get();
        }


        return view("eventos", compact('ceps', 'produtos', 'eventos', 'termo'));
    }

    public function save_cadastro(Request $r)
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

        if ($validator->fails()) {
            return Response::json(array('error' => $validator->getMessageBag()->toArray()));
        } else {

            $endereco = new Endereco();
            $endereco->rua = $r->rua;
            $endereco->numero_residencia = $r->num_local;
            $endereco->id_cep = $r->cep;
            $endereco->bairro = $r->bairro;
            $endereco->save();

            $evento = new Evento();
            $evento->data = $r->data;
            $evento->horario_inicio = $r->hora_ini;
            $evento->horario_fim = $r->horario_fim;
            $evento->id_usuario = Auth::user()->id;
            $evento->id_endereco = $endereco->id_endereco;
            $evento->descricao = $r->descricao;
            if(isset($r->imagem)){
                // variavel que recebe valor unico
                $uniq = uniqid();

                // criando um nome para o arquivo, pegando o nome do arquivo, adicionando valor unico e a extenxao original do arquivo
                $nomeArquivo = 'ID'. $r->imagem->getClientOriginalName(). $uniq.'.'.$r->imagem->getClientOriginalExtension();
                Storage::disk('public')->put('banners_eventos/'.$nomeArquivo, file_get_contents($r->imagem));
                $evento->imagem = $nomeArquivo;
            }else{
                $evento->imagem = 'default_banner.jpeg';
            }
            $evento->titulo_evento = $r->titulo;
            $evento->save();

            if($r->produtos){
                foreach ($r->produtos as $produto) {
                    $prod_evento = new ProdutosEvento();
                    $prod_evento->id_produto = $produto;
                    $prod_evento->id_evento = $evento->id_evento;
                    $prod_evento->save();
                }
            }
        }
    }
    public function visualizar_evento(Request $request, $id){
        $evento = Evento::findOrFail($id);
        return view('visualizar_evento', compact("evento"));
    }

    public function termo_evento(){
        $termo = Termo::where('termo', 'Termo de Responsabilidade para Cadastro de Evento')->first();

        $search = ['[Nome Completo]', '[número do CPF]'];
        $replace = [Auth::user()->nome, Auth::user()->cpf];
        $teste = str_replace($search, $replace, $termo->descricao);

        $termo_ass = str_replace(['@@'], ["<br>"], $teste);

        return $termo_ass;
    }

    public function confirmarcao_termo(Request $r){
        $validator = Validator::make($r->all(), [
            'assinatura' => 'required|string'
        ]);

        if ($validator->fails()) {
            return Response::json(array('error' => $validator->getMessageBag()->toArray()));
        } else {

            $data = $r->assinatura;
            $data = str_replace('data:image/png;base64', '', $data);
            $data = str_replace(' ', '+', $data);
            $decodeData = base64_decode($data);

            $uniqid = uniqid();
            $assinaturaFile = 'assinatura_termo_'.$uniqid.'.png';
            Storage::disk('public')->put('assinatura_termos/'.$assinaturaFile, $decodeData);
            

            $termo = new TermosAssinado();
            $termo->id_usuario = Auth::user()->id;
            $termo->id_termo = $r->id_termo;
            $termo->assinatura = $assinaturaFile;
            $termo->data_assinatura = Carbon::now();
            $termo->save();
        }        
    }
}
