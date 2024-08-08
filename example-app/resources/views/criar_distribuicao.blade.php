@extends('layouts.app')
@section('title', 'Criar Distribuição')
@section('content')

<x-guest-layout>
    <x-auth-card>
        <body>
        <main>
            <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
            </x-slot>

            <!-- top, right, bottom, left-->
            <form method="POST" style = "margin-bottom: 10px">
                
                <div>
                    <div class="row mt-4">
                        <!-- Produto (nome) -->
                        <div>
                            <x-label for="nome" :value="__('PRODUTO')" />

                            <x-input id="produto_nome" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                required autofocus />

                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Preço -->
                        <div class="col col-md-6">
                            <x-label for="preco" :value="__('PREÇO (POR UNIDADE)')" />

                            <x-input id="preco" class="block mt-1 w-full" type="number" name="preco" :value="old('number')"
                                required />
                        </div>
                    </div>
                        {{-- imagem--}}
                    <div>
                        <div class="container">
                            <br>
                            <x-label for="imagem" :value="__('IMAGENS DO PRODUTO')" />
                            <x-input id="imagem" class="block mt-1 w-full" type="file" name="imagem"
                                :value="old('file')" required />
                            <br>
                            <img id="imagePreview" src="" alt = "">

                            
                        </div>

                        <div class="container">
                            <x-input id="imagem_" class="block mt-1 w-full" type="file" name="imagem"
                                :value="old('file')" required />
                        </div>

                    </div>
                    

                    <div class="row mt-4">
                        {{-- Quantidade (limite) --}}
                        <div class="col col-md-6">
                            <x-label for="quantidade" :value="__('QUANTIDADE (LIMITE)')" />

                            <x-input id="qauntidade" class="block mt-1 w-full" type="number" name="quantidade" :value="old('number')"
                                required />
                        </div>

                        {{-- Data de vencimento--}}
                        <div class="col col-md-6">
                            <x-label for="data_vencimento" :value="__('DATA DE VENCIMENTO')" />

                            <x-input id="data_vencimento" class="block mt-1 w-full" type="date" name="data_vencimento"
                                :value="old('data_vencimento')" required />
                        </div>
                    </div>

                    <div class="row mt-4">
                        {{-- Descrição --}}
                        <div>
                            <x-label for="descricao" :value="__('DESCRIÇÃO')" />

                            <x-input id="descricao" class="block mt-1 w-full" type="text" name="descricao" :value="old('descricao')"
                                required />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-button class="ml-4">
                            {{ __('ENVIAR') }}
                        </x-button>
                    </div>
                </div>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.getElementById('imagem');
                const imagePreview = document.getElementById('imagePreview');

                fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.src = e.target.result;
                        imagePreview.style.display = 'block'; // Exibe a imagem
                    };
                    reader.readAsDataURL(file);
                        }
                    });
                });
            </script>
        </body>
        </main>
    </x-auth-card>
</x-guest-layout>

    
@endsection
