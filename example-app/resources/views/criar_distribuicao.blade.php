@extends('layouts.app')
@section('title', 'Criar Distribuição')
@section('content')
{{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}
<x-mensagem />
    <main class="main">
        <div class="container bg-light card-produto rounded-2 p-3" style="width: 600px">
            <form method="POST">
                    @csrf
                    <div class="row pt-3 text-center">
                        <h4>Anunciar Produto</h4>
                    </div>
                        <hr>

                        <div class="row mt-3">
                            <div class="col-md-6 form-group">
                                <label for="produto_nome">PRODUTO</label>
                                <input id="produto_nome" class="form-control" type="text" name="produto_nome" :value="old('produto_nome')"
                                    required autofocus />
                            </div>
                        
                            <div class="col-md-6 form-group">
                                <label for="preco">PREÇO POR UNIDADE</label>
                                <input id="preco" class="form-control" type="number" name="preco" :value="old('preco')"
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
                            
                            <div class="row mt-3">
                                <!-- Input de arquivo escondido -->
                                <input type="file" id="fileInput" name='imagem[]' multiple accept="image/*">

                                
                                <!-- Label estilizado como um botão -->
                                <div class="col-md-6 form-group">
                                <label id="uploadButton" for="fileInput" class = "btn bg-success text-white">{{ __('SELECIONAR IMAGENS') }}</label>
                                </div>
                                
                                
                                <div id="image-preview"></div>
                            </div>
                        

                            <div class="row mt-3">
                                <div class="col-md-6 form-group">
                                <label for="quantidade">QUANTIDADE - LIMITE</label>
                                <input id="quantidade" class="form-control" type="number" name="quantidade" :value="old('number')"
                                    required />
                            </div>

                            
                                <div class="col-md-6 form-group">
                                <label for="data_vencimento">DATA DE VENCIMENTO</label>
                                <input id="data_vencimento" class="form-control" type="date" name="data_vencimento"
                                    :value="old('data_vencimento')" required />
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6 form-group">
                                <label for="descricao">DESCRIÇÃO</label>
                                <input id="descricao" class="form-control" type="text" name="descricao" :value="old('descricao')"
                                    required />
                            </div>
                        </div>
                        <hr>


                        <div class="row px-3 py-1 justify-content-end">
                                <button id = "create" class="btn btn-primary col-md-4 save_edit">
                                    {{ __('Anunciar') }}
                                </button>
                        </div>
            </form>
        </div>
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
                var formData = new FormData($("#save_distribuicao")[0]);
                $.ajax({
                    type: "POST",
                    url: "criar_distribuicao/save_distribuicao",
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
                            window.location.href = '/';
                            
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

    
@endsection
