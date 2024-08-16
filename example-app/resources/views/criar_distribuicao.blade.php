@extends('layouts.app')
@section('title', 'Criar Distribuição')
@section('content')

<x-guest-layout>
    <x-auth-card>
        <body>
        <main>
            <x-slot name="logo">
                
                </x-slot>
    
            <!-- top, right, bottom, left-->
            <form method="POST" style = "margin-bottom: 10px">
                
                <div>
                    <div class="row mt-4">
                        <!-- Produto (nome) -->
                        <div>
                            <x-label for="produto_nome" :value="__('PRODUTO')" />

                            <x-input id="produto_nome" class="block mt-1 w-full" type="text" name="produto_nome" :value="old('produto_nome')"
                                required autofocus />

                        </div>
                    </div>

                    <div class="row mt-4">
                        <!-- Preço -->
                        <div class="col col-md-6">
                            <x-label for="preco" :value="__('PREÇO (POR UNIDADE)')" />

                            <x-input id="preco" class="block mt-1 w-full" type="number" name="preco" :value="old('preco')"
                                required />
                        </div>
                    </div>
                        {{-- imagem--}}
                    <div class="row mt-4">
                        <div class="container col col-md-6">
                            
                            <x-label for="imagem" :value="__('IMAGENS DO PRODUTO')" />
                            <style>
                                /* formatação do botão fake. */
                                .custom-file-upload {
                                    border: 1px solid #ccc;
                                    display: inline-block;
                                    padding: 6px 12px;
                                    cursor: pointer;
                                    background-color: #f0f0f0;
                                    border-radius: 4px;
                                    font-size: 16px;
                                }
                                
                                /* Esconde o input file original, nescessário para fazer um botão costumizavel. */
                                input[type="file"] {
                                    display: none;
                                }
                            </style>
                                
                            <label for="imagem" class="custom-file-upload"> {{-- Botão fake. --}}
                                Escolher Arquivo
                                <br>
                            </label>
                                <br>
                            <input id="imagem" type="file" name="imagem"
                            :value="old('file')" required /> {{-- Input real --}}
                            
                            {{-- reserva --}}
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

                            <x-input id="quantidade" class="block mt-1 w-full" type="number" name="quantidade" :value="old('number')"
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

                    <div class = "row mt-4 justify-content-center">
                        <div class = "text-center">
                    
                            <button id = "register" type = "button" class = "btn bg-success text-white">{{ __('ENVIAR') }}</button>
                                
                            
                        </div>
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
