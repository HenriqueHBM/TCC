<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class DistribuicoesController extends Controller
{
    public function distribuicoes()
    {
        $search = request('search');
        if($search){
            $distribuicoes = Produto::where('produto', 'LIKE', '%'.$search.'%')->get();
        }else{
            $distribuicoes = Produto::get();
        }
        
        return view('distribuicoes', compact('distribuicoes'));
    }

}
