<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'telefone' => 'required',
            'data_nascimento' => ['required', 'date'],
            'cpf' => ['required', 'unique:usuarios','min:11' ,'max:11'],
        ]);

        $foto = '';
        if(empty($request->perfil)){
            $foto = 'default_perfil.png';
        }else{
            $uniq = uniqid();

                // criando um nome para o arquivo, pegando o nome do arquivo, adicionando valor unico e a extenxao original do arquivo
                $nomeArquivo = 'ID'. $uniq.'.'.$request->perfil->getClientOriginalExtension();
                Storage::disk('public')->put('img_perfils/'.$nomeArquivo, file_get_contents($request->perfil));
                $foto = $nomeArquivo;
        }
        
        
        $user = User::create([
            'nome' => $request->name,
            'data_nascimento' => $request->data_nascimento,
            'telefone' => $request->telefone,
            'email' => $request->email,
            'cpf' => $request->cpf,
            'status_login' => 1,
            'foto_perfil' => $foto,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
