<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tbProduto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $linhas = tbProduto::get();
        $i = 0;
        foreach($linhas as $linha){
            $val[$i] = $linha->produto;
            $i++;
        }
        $val = array_chunk($val,5);
        return view('home',compact('linhas','val'));
    }

}
