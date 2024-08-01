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
        $produtos = Produto::get();
        $tipos_prod = ProdutosCategoria::limit(7)->get();
        return view('home',compact('produtos','tipos_prod'));
        
    }
    

}
