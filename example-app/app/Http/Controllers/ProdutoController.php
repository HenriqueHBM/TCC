<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    public function produto($id)
    {
        $linha = Produto::where('id_produto', $id)->first();
        return view('/produto', compact('linha', 'id'));
    }

    public function show_comprar($id){
        $produto = Produto::findOrFail($id);
        $pagamentos = Pagamento::get();
        return view('comprar.show_comprar', compact('produto', 'pagamentos'));
    }

    public function confirmar_compra(Request $r, $id){
        $validator = Validator::make($r->all(), [
            'tp_pagamento' => 'required',
            'qtde_desejada' => 'required'
        ]);
        if ($validator->fails()) {
            return Response::json(array('error' => $validator->getMessageBag()->toArray()));
        } else {

            $produto = Produto::findOrFail($id);
        }
    }
}
