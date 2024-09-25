<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\ProdutosCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $produtos = Produto::where('qtde', '>', 0)->orderBy('created_at', 'desc')->get();
        $tipos_prod = ProdutosCategoria::whereHas('produtos', function($q){
            $q->where('qtde', '>', 0);
        })
        ->limit(7)->get();
        return view('home',compact('produtos','tipos_prod'));
        
    }
    

}
