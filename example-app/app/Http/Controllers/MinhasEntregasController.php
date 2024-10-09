<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
