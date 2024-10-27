<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\Pagamento;
use App\Models\Produto;
use App\Models\Termo;
use App\Models\TermosAssinado;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    public function produto($id)
    {
        $linha = Produto::where('id_produto', $id)->first();
        $termo = Termo::where('termo', 'Termo de Responsabilidade na Compra')->first();

        $pdf = Pdf::loadView('pdf.recibo_compra');
        $uniq = uniqid();

        return $pdf->download('recibo'.$uniq.'.pdf');
        return view('/produto', compact('linha', 'id', 'termo'));
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
            $compra->id_usuario = Auth::user()->id;
            $compra->id_produto = $id;
            $compra->id_pagamento = $r->tp_pagamento;
            $compra->qtde = $r->qtde_desejada;
            $compra->valor_total = $r->total_pagamento;
            $compra->save();

            $produto->qtde -= $r->qtde_desejada;
            $produto->update();
            
            $pdf = Pdf::loadView('pdf.recibo_compra');
            $uniq = uniqid();

            return $pdf->download('recibo'.$uniq.'.pdf');
        }
    }

    public function termo_compra(){
        $termo = Termo::where('termo', 'Termo de Responsabilidade na Compra')->first();

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
