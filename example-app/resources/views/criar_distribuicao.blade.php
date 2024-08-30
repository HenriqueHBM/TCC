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
            <form id = "save_distribuicao" method="POST" style = "margin-bottom: 10px">
                
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
                        <style>
                            #fileInput {
                                display: none;
                            }
                            #image-preview {
                                display: flex;
                                gap: 10px;
                                margin-top: 10px;
                                display: flex;
                                flex-direction: column; /* Empilha as imagens verticalmente */
                            }
                            .preview-img {
                                
                                max-width: 100%; /* Ajusta a imagem ao tamanho do contêiner */
                                height: auto;
                                margin-bottom: 10px; /* Espaçamento entre as imagens */
                            }
                        </style>
                        <div class="row mt-4">
                            <!-- Input de arquivo escondido -->
                            <input type="file" id="fileInput" multiple accept="image/*">

                            
                            <!-- Label estilizado como um botão -->
                            <div class = "row mt-4 justify-content-center">
                                <div class = "text-center">
                            
                                    <label id="uploadButton" for="fileInput" class = "btn bg-success text-white">{{ __('SELECIONAR IMAGENS') }}</label>
                                        
                                    
                                </div>
                            </div>
                            
                            
                            <div class="block mt-1 w-full" id="image-preview"></div>
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
                    
                            <button id = "create" type = "button" class = "btn bg-success text-white">{{ __('ENVIAR') }}</button>
                                
                            
                        </div>
                    </div>

                </div>
            </form>
            <script>
                document.getElementById('fileInput').addEventListener('change', function() {
                    const fileInput = document.getElementById('fileInput');
                    const files = fileInput.files;
                    const maxImages = 5;
                    const imagePreviewDiv = document.getElementById('image-preview');
                    
                    // Limpa as imagens anteriores
                    imagePreviewDiv.innerHTML = '';

                    // Verifica se o número de arquivos selecionados excede o máximo permitido
                    if (files.length > maxImages) {
                        alert(`Você pode selecionar no máximo ${maxImages} imagens.`);
                        return;
                    }

                    // Exibe as imagens selecionadas
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        const reader = new FileReader();
                        
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.classList.add('preview-img');
                            imagePreviewDiv.appendChild(img);
                        };

                        reader.readAsDataURL(file);
                    }
                });

                // botão pra salvar
                $(document).on("click", "#create", function() {
                var formData = new FormData($("#enviar_distribuicao")[0]);
                $.ajax({
                    type: "POST",
                    url: "criar_distribuicao/enviar_distribuicao",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        // Verifica se a resposta do servidor contém um erro
                        if (data.error) {
                            // Exibe uma mensagem de erro para o usuário
                            alert('Erro: ' + data.error);
                        } else {
                            // Se não houver erro, exibe uma mensagem de sucesso
                            alert('Parabéns: ' + data.success);
                            
                            
                        }
                    },
                    error: function(xhr, status, error) {
                        // Caso ocorra algum erro durante a requisição AJAX
                        alert("Ocorreu um erro durante a requisição: " + status + ", " + error);
                        
                    }
                });
                });
            </script>
        </body>
        </main>
    </x-auth-card>
</x-guest-layout>

    
@endsection
