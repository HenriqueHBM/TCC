<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdutoController extends Controller
{
    public function produto($id)
    {
        $linha = Produto::where('id_produto', $id)->first();
        return view('/produto', compact('linha', 'id'));
    }

    public function show_comprar($id){
        $produto = Produto::findOrFail($id);
        return view('comprar.show_comprar', compact('produto'));
    }
}
