<?php

namespace App\Http\Controllers;

use App\Models\tbProduto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function produto(Request $r)
    {
        $linhas = tbProduto::get();
        return view('/produto', compact('linhas'));
    }
}
