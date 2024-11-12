<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\ProdutosCategoria;
use Illuminate\Http\Request;

class DistribuicoesController extends Controller
{
    public function distribuicoes()
    {
        $search = request('search');

        $tipos_prod = ProdutosCategoria::whereHas('produtos', function($q) use($search){
            $q->where('qtde', '>', 0);
            if($search){
                $q->where('produto', 'LIKE', '%'.$search.'%')
                ->orWhere('categoria', 'LIKE', '%'.$search.'%');
            };
        })
        ->get();
        
        return view('distribuicoes', compact( 'tipos_prod'));
    }

}
