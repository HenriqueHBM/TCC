@extends('layouts.app')
@section('title', 'ForLife')
@section('content')
{{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}
<x-mensagem />
    <main class="main">
        
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <div class="container bg-light card-produto rounded-2 p-3" style="width: 600px">
            <form method="POST" action="{{ route('register') }}"  enctype="multipart/form-data">
                @csrf
                <div class="row pt-3 text-center">
                    <h4>Registrar-se</h4>
                </div>

                <hr>
                
                <div class="row justify-content-center ">
                    <div>
                        <label class="form-label" for="perfil">Foto de Perfil</label>
                        <input type="file" name="perfil" id="perfil" class="form-control p-2 ">
                    </div>
                    
                </div>
                <div class="row justify-content-center">

                    <img id="imagePreview" src="#" alt="Pré-visualização" style="display: none; width: 100px;height:100px; margin-top: 20px; border-radius:50%;" class="p-0 bg-light border border-3 card_produto" />
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label class="form-label" for="nome">Nome</label>
                        <input id="nome" class="form-control" type="text" name="name" :value="old('name')"
                            required autofocus />
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-label" for="email">Email</label>
                        <input id="email" class="form-control" type="email" name="email" :value="old('email')"
                            required />
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label class="form-label" for="telefone">Telefone</label>
                        <input id="telefone" class="form-control" type="tel" name="telefone" :value="old('telefone')"
                            required
                            placeholder='(DD) 00000-0000' />
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-label" for="data_nascimento">Data Nascimento</label>
                        <input id="data_nascimento" class="form-control" type="date" name="data_nascimento"
                            :value="old('data_nascimento')" required />
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label class="form-label" for="cpf">CPF</label>
                        <input id="cpf" class="form-control" type="text" name="cpf" :value="old('cpf')"
                            required />
                    </div>
                </div>


                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                    <label class="form-label" for="password">Senha</label>
                    <input id="password" class="form-control" type="password" name="password" required
                        autocomplete="new-password" />
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-label" for="password_confirmation">Confirmar Senha</label>
                        <input id="password_confirmation" class="form-control" type="password"
                        name="password_confirmation" required />
                    </div>
                </div>

                <hr>
                <div class="row px-3 py-1 justify-content-between">
                    <a class="col-md-4 text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <button class="btn btn-primary col-md-4 save_edit">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
        </div>
    </main>


<script>
    document.getElementById('perfil').addEventListener('change', function(event) {
        var file = event.target.files[0];
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.getElementById('imagePreview');
                img.src = e.target.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection