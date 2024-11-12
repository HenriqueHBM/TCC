<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class PerfilController extends Controller
{
    public function perfil()
    {
        return view("perfil");
    }

    public function save_perfil(Request $r)
    {
        $usuario = User::findOrFail(Auth::user()->id);

        $validator = Validator::make($r->all(), [
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'telefone' => 'required',
            'dt_nascimento' => 'required|date',
            'cpf' => 'required|unique:usuarios,cpf,' . $usuario->id,
            'senha' => 'required',
            'nova_senha' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'nova_senha_confirmation' => 'required_with:nova_senha'
        ]);

        if ($validator->fails()) {
            return Response::json(array('error' => $validator->getMessageBag()->toArray()));
        } else if (!Hash::check($r->senha, $usuario->password)) {
            return Response::json('Senha Invalida');
        } else {

            $usuario->nome = $r->nome;
            $usuario->data_nascimento = $r->dt_nascimento;
            $usuario->telefone = $r->telefone;
            $usuario->email = $r->email;
            $usuario->cpf = $r->cpf;

            if($r->nova_senha){
                $usuario->password = Hash::make($r->nova_senha);
            }
            if($r->foto_perfil){
                if($r->foto_perfil !== $usuario->foto_perfil){
                    $uniq = uniqid();

                    $nomeArquivo = 'ID'. $uniq.'.'.$r->foto_perfil->getClientOriginalExtension();
                    Storage::disk('public')->put('img_perfils/'.$nomeArquivo, file_get_contents($r->foto_perfil));
                    $foto = $nomeArquivo;

                    $usuario->foto_perfil = $foto;
                }
            }
            $usuario->update();
            
        }
    }
}
