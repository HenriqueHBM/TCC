<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Evento;
use App\Models\ProdutosImagem;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EditarEventoController extends Controller
{
    public function editar_evento()
    {
        $eventos = Evento::where('id_usuario', Auth::user()->id)->get();
        return view('editar_evento',compact('eventos'));
        
    }
}
