@extends('layouts.app')
@section('title', 'Produto')
@section('content')
<x-mensagem />
    <main class="main">
        <div class="container mt-4 d-flex">
            <div class="d-flex">
                <div class="d-inline">
                    <img id="principal" src="{{  url('storage/img_produtos_users/' . $linha->imagens->first()->imagem) }}"
                        class="rounded card_produto" alt="{{ $linha->produto }}" width="600" height="653">
                </div>
                <div class="d-block" style="height:650px">
                    @foreach ($linha->imagens as $img)
                        <button class="d-block btn slides p-0 m-3" data-img='{{ $img->imagem }}'>
                            <img src="{{  url('storage/img_produtos_users/' . $img->imagem) }}" class="rounded card_produto"
                                width="105" height="110" alt="{{ $linha->produto }}">
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="container p-4">
                <div class=" rounded border-2 p-3 mb-3 h-25 card_produto">
                    <h3>
                        {{ $linha->produto }}
                    </h3>
                    <hr>
                    <h6 class="font">Publicado em: {{ data_format($linha->created_at) }}</h6>
                    <h6 class="font">
                        Cód. {{ $linha->codigo }}
                    </h6>
                    <h6 class="font pb-3">(Qtde: {{ $linha->qtde }})</h6>
                </div>
                <div class=" rounded border-2 p-3 mb-3 card_produto">
                    <h4>
                        R$: {{ $linha->preco }}
                    </h4>
                </div>
                <textarea class="rounded border-2 p-3 mb-3 card_produto textarea_produto w-100" rows="4" readonly>{{ $linha->descricao }}</textarea>
                <div class="p-2  rounded border-2 card_produto mb-3 d-flex">
                    <div class="d-flex">
                        <img src="{{ url('storage/img_perfils/' . $linha->usuario->foto_perfil) }}" alt="a"
                            class="rounded-circle d-inline border border border-3 card_produto" width="100"
                            height="100">
                    </div>
                    <div class="p-3 pt-4">
                        Vendedor: {{ $linha->usuario->nome }} <br>
                        Usuário desde: {{ data_format($linha->usuario->created_at) }}
                    </div>
                </div>
                {{-- Verifica se usuario esta logado --}}
                @auth
                {{-- Verifica se o usuario tem o termo de compra assinado --}}
                    @if (empty(Auth::user()->id_endereco))
                    <a href="{{ url('/cadastrar_endereco') }}" class=" button_comprar p-3 text-white card_shadow ">
                        <img src="{{ asset('icons/cesta-de-compras.png') }}" alt="" width="25" height="25"
                            class="mb-1"> Comprar
                    </a>
                    @else
                        @if (count(Auth::user()->termos_compra) > 0 )
                            <button class="button_comprar p-3 card_shadow" data-id='{{ $id }}' id="button_comprar">
                                <img src="{{ asset('icons/cesta-de-compras.png') }}" alt="" width="30" height="30"
                                    class="mb-1"> Comprar
                            </button>
                        @else
                            <button class=" p-3 text-white card_shadow button_comprar" data-id='{{ $id }}' id="confirmar_termos">
                                <img src="{{ asset('icons/cesta-de-compras.png') }}" alt="" width="25" height="25"
                                    class="mb-1"> Comprar
                            </button>
                        @endif
                    @endif
                @else
                    <a href="{{ url('login') }}" class=" button_comprar p-3 text-white card_shadow ">
                        <img src="{{ asset('icons/cesta-de-compras.png') }}" alt="" width="25" height="25"
                            class="mb-1"> Comprar
                    </a>
                @endauth
            </div>
        </div>
    </main>
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modal-body">

            </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="eventoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Termos de Responsabilidade para Compra de Produto</h1>
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
                                <canvas id="canvas" class="border border-2" width="700" height="200"
                                    name='a'></canvas>
                            </div>
                            <div class="form-row text-center">
                                <button id="clear"class="btn btn-warning card_produto">Limpar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Recusar</button>
                    <button type="button" class="btn btn-success" data-id='{{ $id }}' id="save_termo">Enviar Assinatura</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Fim Modal Termo --}}
    <script>
        let old = '';
        $(document).ready(function() {
            old = $('.slides').eq(0).addClass('slide_pressed');
        });


        $(document).on('click', '.slides', function(e) {
            if (old) {
                old.removeClass('slide_pressed');
            }
            let src = $(this).data('img');
            $('#principal').prop('src', "{{ asset('img_folders') }}/" + src);
            $(this).addClass('slide_pressed');

            old = $(this);
        });

        $(document).on('click', '#button_comprar', function(e) {
            let id = $(this).data('id');
            $.ajax({
                type: 'get',
                url: `${id}/show_comprar`,
                success: function(data) {
                    $('#modal-body').html(
                        data); // corpo do modal recebendo as informacoes da outra tela;

                    let total = valor_total($('#preco_produto').val(),
                        10); // 10% do pix                    

                    $('#qtde_estoque').text(
                        `(Qtde. Estoque: ${parseInt($('#qtde_estoque_insere').val()) - parseInt($('#qtde_desejada').val())})`
                    );
                    return_total(total);

                    $('#Modal').modal('show');
                    e.preventDefault();
                }
            })
        });

        $(document).on('click', '.mudar_input_pagamento', function(e) {
            let desconto = valor_desconto($(this).val());
            let qtde = $('#qtde_desejada').val();
            let total = valor_total($('#preco_produto').val(), desconto, qtde);

            $('#desconto_pagamento').text(`(${desconto}% de Desconto)`);
            $('#val_desconto_insere').val(desconto);

            return_total(total);
        });

        $(document).on('change', '#qtde_desejada', function() {
            let desconto = $('#val_desconto_insere').val();
            let qtde = $(this).val();
            let total = valor_total($('#preco_produto').val(), desconto, qtde);

            $('#qtde_estoque').text(
                `(Qtde. Estoque: ${parseInt($('#qtde_estoque_insere').val()) - parseInt(qtde)})`);
            return_total(total);

        })

        //Funcoes / procedimentos
        function valor_total(val_prod, desconto, qtde = 1) {
            let conta = (val_prod * desconto) / 100;
            conta = val_prod - conta;
            total = conta * qtde;
            return total.toFixed(2);
        }

        function return_total(total) {
            $('#show_total').text(total);
            $('#total_pagamento').val(total);
        }

        function valor_desconto(id) {
            let valor = 0;
            switch (true) {
                case id == 1:
                    valor = 10;
                    break;
                case id == 2:
                    valor = 4;
                    break;
                case id == 3:
                    valor = 7;
                    break;
                default:

                    break;
            }
            return valor;
        }
        //Fim Funcoes

        //Acoes
        $(document).on('click', '#confirmar_compra', function(e) {
            e.preventDefault();
            var formData = new FormData($('#confirmarPagamentoForm')[0]);
            let id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: `confirmar_compra/${id}`,
                data: formData,
                cache: false,
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.error) {
                        //e.preventDefault();
                        setTimeout(function() {
                            //$('#Modal').modal('show'); //caso erro, puxar a tela 
                            $.each(data.error, function(index, element) {
                                $('.error_' + index).prop('hidden', false);
                                $('.error_' + index).text(element);
                            });
                        }, 100);
                    } else {
                        $('#Modal').modal('toggle');
                        $('#mensg_sucesso').text('Compra Efetuada com Sucesso');
                        $('#mensg_sucesso').prop('hidden', false);

                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });

                        setTimeout(function() {
                            window.location.href = '/';
                        }, 1500);
                    }
                }
            });
        })
        //Fim Acoes

        $(document).on('click', '#confirmar_termos', function(){
            let id = $(this).data('id');
            $.ajax({
                type:'get',
                url: `${id}/termo_compra`,
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
        $(document).on('click', '#clear', function(e) {
            e.preventDefault();
            signaturePad.clear();
        })


        $(document).on('click', '#save_termo', function() {
            if (signaturePad.isEmpty()) {
                alert("Por favor, faça sua assinatura primeiro.");
            } else {
                let id = $(this).data('id');
                var formData = new FormData($('#salvarTermoForm')[0]);
                const dataURL = signaturePad.toDataURL();
                formData.append('assinatura', dataURL);

                $.ajax({
                    type: 'post',
                    url: `${id}/confirmarcao_termo`,
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#mensg_sucesso').text('Termo Assinado Com Sucesso');
                        $('#mensg_sucesso').prop('hidden', false);
                        $('#eventoModal').modal('toggle');

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
