<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    public function editar_evento($id){
        $meus_eventos = Evento::findOrFail($id);
        return view('editar_evento', compact('meus_eventos'));
    }
}