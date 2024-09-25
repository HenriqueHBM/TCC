<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Pagamento;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

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

        $produto = Produto::findOrFail($id);
        if ($validator->fails()) {
            return Response::json(array('error' => $validator->getMessageBag()->toArray()));
        } else if($r->qtde_desejada < 1 || $r->qtde_desejada > $produto->qtde){
            return Response::json(array('error' => ['qtde_desejada' => 'O campo qtde desejado passou da quantidade do estoque']));
        }
        else {

            $compra = new Compra();
            $compra->id_usuario = Auth::user()->id_usuario;
            $compra->id_produto = $id;
            $compra->id_pagamento = $r->tp_pagamento;
            $compra->qtde = $r->qtde_desejada;
            $compra->valor_total = $r->total_pagamento;
            $compra->save();

            $produto->qtde -= $r->qtde_desejada;
            $produto->update();
        }
    }
}
