@extends('layouts.app')
@section('title', 'Eventos')
@section('content')
<div class="text-center align-content-center w-100 text-white card_produto" hidden id="mensg_sucesso" style="height:60px; background-color:rgb(0, 186, 71)">
    <h3>Termos Assinado Com Sucesso</h3>
</div>
    <main>
        <div class="container mt-5">
            <div class="row justify-content-between">
                <div class="col-md-3 mb-2">
                    <h3>Eventos</h3>
                </div>
                @auth
                    <div class="col-sm-1 me-2">
                        @auth
                            @if (count(Auth::user()->termos_evento) > 0)
                                <butotn class="btn btn-sm btn-success add-modal" >Cadastrar</butotn>
                            @else
                                <button class="btn btn-sm btn-success" id="confirmar_termos">Cadastrar</button>
                            @endif
                        @endauth
                    </div>
                @endauth
            </div>
            <div class="my-4">
                @foreach ($eventos as $evento)
                    <div class="card mb-3 w-100" style="height: 200px">
                        <div class="row">
                            <div class="col-md-4" >
                                <img src="{{ url('storage/banners_eventos/' . $evento->imagem) }}"
                                    class="img-fluid rounded-start w-100" alt="Banner Evento" style="height:198px">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $evento->titulo_evento }}</h5>
                                    <p class="card-text">
                                        {{ $evento->descricao }}
                                    </p>
                                    <p>
                                    <h6> Nome da Empresa Aqui</h6>
                                    </p>
                                    <p class="card-text">
                                        <small class="text-body-secondary">
                                            Última Atualização: {{ ($evento->updated_at) }}
                                        </small>
                                    </p>
                                    <a href="eventos/visualizar_evento/{{ $evento->id_evento }}" class="stretched-link"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>
    {{-- Modal de Cadastro --}}
    <div class="modal fade modal-lg" id="cadastrarModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="cadastrarEventoForm" method="post">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Cadastrar Evento</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-sm-6 form-group">
                                <label for="titulo_add" class="form-label">Titulo do Evento</label>
                                <input type="text" id="titulo_add" name="titulo" class="form-control ">
                                <p class="alert error_titulo alert-danger" role="alert" hidden></p>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label for="imagem_add" class="form-label">Capa Para o Evento</label>
                                <input class="form-control" type="file" id="imagem_add" name="imagem">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6 form-group">
                                <label for="data_add" class="form-label">Data do Evento</label>
                                <input type="date" name="data" id="data_add" class="form-control">
                                <p class="alert error_data alert-danger" role="alert" hidden></p>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label for="hora_ini_add" class="form-label">Horário Inicio</label>
                                <input type="time" name="hora_ini" id="hora_ini_add" class="form-control">
                                <p class="alert error_hora_ini alert-danger" role="alert" hidden></p>
                            </div>
                            <div class="col-sm-3 form-group">
                                <label for="hora_fim_add" class="form-label">Horário Fim</label>
                                <input type="time" name="hora_fim" id="hora_fim_add" class="form-control">
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
                                        <option selected>...</option>
                                        @foreach ($ceps->sortBy('sigla') as $cep)
                                            <option value="{{ $cep->id_cep }}">{{ $cep->sigla }} {{ $cep->cidade }} -
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
                                    <input type="text" name="num_local" id="num_local_add" class="form-control">
                                    <p class="alert error_num_local alert-danger" role="alert" hidden></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="rua_add" class="form-label">Rua</label>
                                    <input type="text" name="rua" id="rua_add" class="form-control">
                                    <p class="alert error_rua alert-danger" role="alert" hidden></p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="bairro_add" class="form-label">Bairro</label>
                                    <input type="text" name="bairro" id="bairro_add" class="form-control">
                                    <p class="alert error_bairro alert-danger" role="alert" hidden></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="descricao_add" class="form-label">Descrição do Evento</label>
                                    <textarea class="form-control" id="descricao_add" name="descricao" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary" id="save_cadastro">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Fim Modal de Cadastro --}}

    {{-- Modal Para o Termos --}}/
    <div class="modal fade modal-lg" id="eventoModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Termos de Responsabilidade para Cadastro de Evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="salvarTermoForm">
                        @csrf
                        <input type="hidden" name="id_termo" value="{{ $termo->id_termo }}">
                        <div id="termos_body"></div>
                        <div class="mt-4">
                            <div class="form-row text-center ">
                                <h5>Assinatura do Responsável</h5>
                            </div>
                            <div class="form-row text-center ">
                                <canvas id="canvas" class="border border-2" width="700" height="200" name='a'></canvas>
                            </div>
                            <div class="form-row text-center">
                                <button id="clear"class="btn btn-warning card_produto">Limpar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Recusar</button>
                    <button type="button" class="btn btn-success" id="save_termo">Enviar Assinatura</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Fim Modal Termo --}}
    
    
    <script>
        // add-modal

        $(document).on('click', '.add-modal', function(e) {
            e.preventDefault();
            $('#cadastrarModal').modal('show');
        });

        $(document).on('click', '#save_cadastro', function() {
            var formData = new FormData($('#cadastrarEventoForm')[0]);
            $.ajax({
                type: 'POST',
                url: 'eventos/save_cadastro',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    // Verifica se a resposta do servidor contém um erro
                    if (data.error) {
                        // Exibe uma mensagem de erro para o usuário
                        // alert('Erro: ' + data.error);

                        $.each(data.error, function(index, element) {
                            $('.error_' + index).prop('hidden', false);
                            $('.error_' + index).text(element);
                        })

                        $('#cadastrarModal').modal('show');
                    } else {
                        // Se não houver erro, recarreg a pagina
                        location.reload();
                    }
                },
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

        $(document).on('click', '#confirmar_termos', function(){
            $.ajax({
                type:'get',
                url: 'eventos/termo_evento',
                success:function(data){
                    $('#termos_body').html(data);
                    $('#eventoModal').modal('show');
                }
            })
        });


        const { jsPDF } = window.jspdf;
        const canvas = document.getElementById('canvas');
        const signaturePad = new SignaturePad(canvas);
        const doc = new jsPDF();

        // Limpar assinatura
        $(document).on('click', '#clear', function(e){
            e.preventDefault();
            signaturePad.clear();
        })


        $(document).on('click', '#save_termo', function(){
            if (signaturePad.isEmpty()) {
                alert("Por favor, faça sua assinatura primeiro.");
            } else {
                var formData = new FormData($('#salvarTermoForm')[0]);
                const dataURL = signaturePad.toDataURL();
                formData.append('assinatura', dataURL);

                $.ajax({
                    type:'post',
                    url: 'eventos/confirmarcao_termo',
                    data:formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                        $('#mensg_sucesso').prop('hidden', false);
                        $('#eventoModal').modal('toggle')

                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
                        
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 1000);
                    }
                })
            }
        });
    </script>
@endsection
