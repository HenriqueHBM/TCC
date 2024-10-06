<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MinhasEntregasController extends Controller
{
    public function minhas_entregas()
    {
        $produtos = Produto::where('id_usuario', Auth::user()->id_usuario)->get();
        return view('minhas_entregas', compact('produtos'));
    }
}
