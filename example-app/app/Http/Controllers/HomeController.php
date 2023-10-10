<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\ProdutosCategoria;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $produtos = Produto::get();
        $tipos_prod = ProdutosCategoria::get();
        return view('home',compact('produtos','tipos_prod'));
    }

}
