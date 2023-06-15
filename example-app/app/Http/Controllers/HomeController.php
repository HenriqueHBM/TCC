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
        return view('home',compact('linhas'));
    }

}
