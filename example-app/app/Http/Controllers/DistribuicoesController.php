<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutosCategoria;
use Illuminate\Http\Request;

class DistribuicoesController extends Controller
{
    public function distribuicoes()
    {
        $tipos_prod = ProdutosCategoria::whereHas('produtos', function($q){
            $q->where('qtde', '>', 0);
        })
        ->get();
        
        return view('distribuicoes', compact( 'tipos_prod'));
    }

}
