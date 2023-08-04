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

        $tipos = TiposProduto::get();

        $i = 0;
        foreach($tipos as $tipo){
            $array[$i] = $linhas->where('id_tipos_produtos', $tipo->id_tipos_produtos);
            $i++;
        }

        $x = 0;
        foreach($array as $arr){
            $divisao[$x] = $arr;
            $x++;
        }

        $divisao = array_chunk($divisao,5);
        return view('home',compact('linhas','divisao', 'produtos','tipos_prod'));
    }

}
