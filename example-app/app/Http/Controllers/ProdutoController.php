<?php

namespace App\Http\Controllers;

use App\Models\tbProduto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function produto($id)
    {
        $linha = tbProduto::findOrFail($id);
        return view('/produto', compact('linha'));
    }
}
