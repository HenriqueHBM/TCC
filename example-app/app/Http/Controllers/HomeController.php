<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use App\Models\TiposProduto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $linhas = Produto::get();
        $tipos_prod = TiposProduto::get();
        $i = 0;
        foreach($linhas as $linha){
            $produtos[$i] = $linha;
            $i++;
        }
        $produtos = (array_chunk($produtos,5));
        
        return view('home',compact('linhas','produtos','tipos_prod'));
    }

}
