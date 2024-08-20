<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function produto($id)
    {
        $linha = Produto::where('id_produto', $id)->first();
        return view('/produto', compact('linha'));
    }
}
