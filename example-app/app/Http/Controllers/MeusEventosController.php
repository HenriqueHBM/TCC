<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cep;
use App\Models\Evento;
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
            $produtos = Produto::where("id_usuario", Auth::user()->id)->where('qtde', '>', 0 )->get();
        }

        return view('eventos.editar_evento', compact('meu_evento', 'ceps', 'produtos'));
    }
}