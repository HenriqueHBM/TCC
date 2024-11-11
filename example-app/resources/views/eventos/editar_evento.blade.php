@extends('layouts.app')
@section('title', 'Editar Produto')
@section('content')
    <x-mensagem />
    <main class="main">
        <div class="container bg-light card-produto rounded-2 p-3" style="width: 600px">
            <form action="" method="POST" id="editForm">
                @csrf
                <div class="row pt-3 text-center">
                    <h4>Editar Evento</h4>
                </div>
                <hr>
                
                <div class="row justify-content-center">
                    <div>
                        <label for="show_img" class="form-label font">Imagem do Evento</label>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <x-verifica-img class="p-0 bg-light border border-3 card_produto p-3" id="imagePreview"
                    :img="$meu_evento" storage='banners_eventos' height='200' width='200' 
                        alt='imagem do seu evento' alt='Pré-visualização'  />
                </div>
                <input type="file" hidden id="show_img" name="show_img">
                <div class="row mt-3">
                    <div class="form-group text-center">
                            <label class="btn btn-warning" for='show_img'
                                title='(Selecione sua Imagem)'>Alterar Imagem</label>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 form-group">
                        <label for="titulo" class="form-label">Título Evento</label>
                        <input type="text" name="titulo" id="titulo" class="form-control"
                            value='{{ $meu_evento->titulo_evento }}'>
                        <p class="alert error_titulo alert-danger" role="alert" hidden></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-6 form-group">
                        <label for="data_add" class="form-label">Data do Evento</label>
                        <input type="date" name="data" id="data_add" class="form-control" value='{{ $meu_evento->data }}'>
                        <p class="alert error_data alert-danger" role="alert" hidden></p>
                    </div>
                    <div class="col-sm-3 form-group">
                        <label for="hora_ini_add" class="form-label">Horário Inicio</label>
                        <input type="time" name="hora_ini" id="hora_ini_add" class="form-control" value="{{ $meu_evento->horario_inicio }}">
                        <p class="alert error_hora_ini alert-danger" role="alert" hidden></p>
                    </div>
                    <div class="col-sm-3 form-group">
                        <label for="hora_fim_add" class="form-label">Horário Fim</label>
                        <input type="time" name="hora_fim" id="hora_fim_add" class="form-control" value="{{ $meu_evento->horario_fim }}">
                        <p class="alert error_hora_fim alert-danger" role="alert" hidden></p>
                    </div>
                </div>
                <div class="mt-4">
                    Produtos(Opcional)
                    <hr>
                </div>
                <div class="row mb-3 justify-content-center ">
                    <button class="btn btn-sm col-sm-1 add_produto">
                        <img src="{{ asset('icons/mais.png') }}" alt="Adicionar" width="40" height="40">
                    </button>
                </div>
                @if ($meu_evento->produtos)
                    @foreach ($meu_evento->produtos as $produto)
                        <div class="row ">
                            <div class="row mb-3">
                                <div class=" form-group col-md-11">
                                    <input type="text" name=""  class="form-control" value="{{ $produto->produto->produto}}">
                                </div>
                                <div class='form-group col-sm-1 text-center'>
                                    <button class='btn btn-sm remover'>
                                        <img src='{{ asset('icons/excluir.png') }}' alt='Remover' width='33' height='33'>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
                <div class="row mb-3" id="produtos">

                </div>
                <div class="mt-4">
                    Informações do Endereço
                    <hr>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="cep_add" class="form-label">CEP</label>
                            <select name="cep" id="cep_add" class="form-control">
                                <option selected value="{{ $meu_evento->endereco->id_cep }}">{{ $meu_evento->endereco->ceps->cidade }}/{{ $meu_evento->endereco->ceps->sigla }}</option>
                                @foreach ($ceps->sortBy('sigla') as $cep)
                                    <option value="{{ $cep->id_cep }}">{{ $cep->cidade }}/{{ $cep->sigla }} -
                                        {{ $cep->cep }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="alert error_cep alert-danger" role="alert" hidden></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="num_local_add" class="form-label">Número Local</label>
                            <input type="text" name="num_local" id="num_local_add" class="form-control" value="{{ $meu_evento->endereco->numero_residencia }}">
                            <p class="alert error_num_local alert-danger" role="alert" hidden></p>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="rua_add" class="form-label">Rua</label>
                            <input type="text" name="rua" id="rua_add" class="form-control" value="{{ $meu_evento->endereco->rua }}">
                            <p class="alert error_rua alert-danger" role="alert" hidden></p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="bairro_add" class="form-label">Bairro</label>
                            <input type="text" name="bairro" id="bairro_add" class="form-control" value="{{ $meu_evento->endereco->bairro }}">
                            <p class="alert error_bairro alert-danger" role="alert" hidden></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="descricao_add" class="form-label">Descrição do Evento</label>
                            <textarea class="form-control" id="descricao_add" name="descricao" rows="4" >{{ $meu_evento->descricao }}</textarea>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row px-3 py-1 justify-content-between">
                    <a href="/minhas_entregas" class="btn btn-warning col-md-4">Voltar</a>
                    <button class="btn btn-primary col-md-4 save_edit" id="save_edit">Salvar Alteração</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        document.getElementById('show_img').addEventListener('change', function(event) {
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

        $(document).on('click', '#save_edit', function(e) {
            e.preventDefault();
            var formData = new FormData($('#editForm')[0]);
            $.ajax({
                type: 'post',
                url: `editar/save_editar`,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.error){
                        setTimeout(function() {
                            $.each(data.error, function(index, element) {
                                $('.error_' + index).prop('hidden', false);
                                $('.error_' + index).text(element);
                            });
                        }, 100);
                    }else{
                        $('#mensg_sucesso').text('Editado Com Sucesso');
                        $('#mensg_sucesso').prop('hidden', false);
                        //Funcao para voltar ao topo da pagina;
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
    
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 1000);
                    }
                }
            })
        });

        $(document).on('click', '.add_produto', function(e) {
            e.preventDefault();
            $('#produtos').append(
                "<div class='row mb-3'>" +
                "<div class='form-group col-md-11'>" +
                "<select class='form-control'  name='produtos[]'>" +
                "<option selected='selected' >Nenhum produto Selecionado</option>" +
                @if (isset($produtos))
                    @foreach ($produtos as $produto)
                        "<option value='{{ $produto->id_produto }}'>{{ $produto->produto }} - Quantidade: {{ $produto->qtde }}</option>" +
                    @endforeach
                @endif
                "</select>" +
                "</div>" +
                "<div class='form-group col-sm-1 text-center'>" +
                "<button class='btn btn-sm remover'>" +
                "<img src='{{ asset('icons/botao-x.png') }}' alt='Remover' width='30' height='30'>" +
                "</button>" +
                "</div>" +
                "</div>"

            )

        })

        $(document).on('click', '.remover', function() {
            $(this).parent().parent().remove();
        });
    </script>
@endsection
