@extends('layouts.app')
@section('title', 'Produto')
@section('content')
    <main style="padding:100px">
        <div class="container mt-4 d-flex">
            <div class="d-flex">
                <div class="d-inline">
                    <img id="principal" src="{{ asset('img_folders/' . $linha->imagens->first()->imagem) }}" class="rounded card_produto"
                        alt="{{ $linha->produto }}" width="600" height="653">
                </div>
                <div class="d-block" style="height:650px">
                    @foreach ($linha->imagens as $img)
                        <button class="d-block btn slides p-0 m-3" data-img='{{ $img->imagem }}'>
                            <img src="{{ asset('img_folders/' . $img->imagem) }}" class="rounded card_produto" width="105"
                                height="110" alt="{{ $linha->produto }}">
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
                    <h6 class="font">Pblicado em : {{ data_format($linha->created_at) }}</h6>
                    <h6 class="font">
                        Cód. {{ $linha->codigo }}
                    </h6>
                </div>
                <div class=" rounded border-2 p-3 mb-3 card_produto">
                    <h4>
                        R$: {{ $linha->preco }}
                    </h4>
                </div>
                <textarea class="rounded border-2 p-3 mb-3 card_produto textarea_produto w-100"  rows="5" readonly>{{ $linha->descricao }}</textarea>
                <div class="p-2  rounded border-2 card_produto mb-3 d-flex">
                    <div class="d-flex">
                        <img src="https://github.com/HenriqueHBM.png" alt="a" class="rounded-circle d-inline border"
                            width="100" height="100">
                    </div>
                    <div class="p-3 pt-4">
                        Vendedor: {{ $linha->usuario->nome }} <br>
                        Usuário desde: {{ data_format($linha->usuario->created_at) }}
                    </div>
                </div>
                @auth
                    <button class="button_comprar p-3  card_shadow" data-id='{{ $id }}'>
                        <img src="{{ asset('icons/cesta-de-compras.png') }}" alt="" width="30" height="30"
                            class="mb-1"> Comprar
                    </button>

                @else
                    <a href="{{ url('login') }}" class="btn button_comprar p-3  card_shadow">
                        <img src="{{ asset('icons/cesta-de-compras.png') }}" alt="" width="25" height="25"
                            class="mb-1"> Comprar
                    </a>
                @endauth
            </div>
        </div>
    </main>
    <div class="modal fade" id="Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modal-body" >

            </div>
        </div>
    </div>

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

        $(document).on('click', '.button_comprar', function(e){
            let id = $(this).data('id');
            $.ajax({
                type:'get',
                url: `${id}/show_comprar`,
                success:function(data){
                    $('#modal-body').html(data),
                    $('#Modal').modal('show');
                    e.preventDefault();
                }
            })
        });

        $(document).on('click', '.mudar_input_pagamento', function(e){
            
            let desconto = $(this).val();
            $('#desconto_pagamento').text(`(${desconto}% de Desconto)`) ;

            
        });
    </script>
@endsection
