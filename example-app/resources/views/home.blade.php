@extends('layouts.app')
@section('title', 'ForLife')
@section('content')
    {{-- Carousel de Imagens --}}
    {{-- container, justify...(coloca o conteudo centralizado), mt-4(margin-top) --}}
    <div class="container justify-content-center mt-4 ">
        <div id="carouselSite" class="carousel slide " data-bs-ride="carousel">
            <div class="carousel-indicators">
                {{-- Navegacao em barras, #carouselSite passa ao id em que se refere, e slide-to, um valor ao referindo --}}
                <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner rounded">
                {{-- deixar 1º banner ativo --}}
                <div class="carousel-item active">
                    {{-- img-fluid(aplica max-width e max-height) imagens de 1000x300px --}}
                    <img src="{{ asset('img_folders/forlife01banner.jpg') }}" class=" img-fluid w-100" alt="Banner ForLife">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img_folders/forlife02banner.jpg') }}" class="img-fluid w-100" alt="Banner ForLife">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img_folders/forlife03banner.jpg') }}" class=" img-fluid w-100" alt="Banner ForLife">
                </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSite" data-bs-slide="prev">
                {{-- span com icone de voltar/avancar --}}
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSite" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
    {{-- Fim Carousel de Imagens --}}

    {{-- Cards --}}
        <main>
            <div class="container">
                {{-- Geral --}}
                {{-- my = margin(top/bottom), rounded(redondar bordas) --}}
                <div class="my-2">
                    <div class="my-4 p-4 rounded" style="background-color:rgb(255, 246, 246) ">
                        {{-- row(linha) --}}
                        <div class="row">
                            {{-- col(coluna), ms = margin(left) --}}
                            <div class="col-12 text-left ms-3 fs-4">
                                {{-- fs = font-size --}}
                                <img src="{{ asset('./icons/prato.png') }}" alt="Geral" width="40" height="40" class="mb-1">
                                Geral
                                <hr class="mt-0 ">
                            </div>
                        </div>
                        {{-- row => linha e text-center == texto centralizado --}}
                        <div class="row text-center">
                            {{-- Cards --}}
                            <div id="carouselCards" class="carousel slide">
                                <div class="carousel-inner">
                                    {{-- contador comecando em zero --}}
                                    <span hidden>{{$x = 0}}</span>
                                    {{-- percorendo cada linha do banco --}}
                                    @foreach ($produtos as $produto)
                                    {{-- caso $x/5 e o resto for 0, esses 5 cards serao os ativos, e o resto itens --}}
                                        @if ($x % 5 == 0)
                                            <div class="carousel-item {{ $x == 0 ? 'active' : '' }}">
                                        @endif
                                        {{-- definindo como um card, margin-left-right, colunas small e  botando em horizontal--}}
                                        <a href="produto/{{ $produto->id_produto }}">
                                            {{-- cards-shadow: css para adc sombra --}}
                                            <div class="card mx-1 col-sm-2 d-inline-block cards-shadow font" >
                                                {{-- cabecalho do card --}}
                                                <div class="card-head">
                                                    <div class="card_img">
                                                        <x-verifica-img href="produto/{{ $produto->id_produto }}" class="card-img-top h-100 card_zoom" :img="$produto->imagens->first()" storage='img_produtos_users' />
                                                    </div>
                                                    {{-- corpo do card --}}
                                                    <div class="card-body font" >
                                                        {{-- titulo do card --}}
                                                        <h5 class="card-title text-dark font">{{ $produto->produto }}</h5>
                                                        {{-- texto/descricao no card --}}
                                                        <p class="card-text text-dark">R$: {{ $produto->preco }}</p>
                                                        {{-- transformando o card inteiro como um link para o produto --}}
                                                    </div>
                                                    {{-- Card footer, secondary(cinza) font_sm(css pro tamanho da fonte) --}}
                                                    <div class="card-footer text-secondary font">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        {{ $produto->vendedor->endereco->ceps->cidade}}/
                                                        {{ $produto->vendedor->endereco->ceps->sigla }}
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        {{-- span hidden == contador --}}
                                        <span hidden>{{$x++}}</span>
                                        @if ($x % 5 == 0)
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                {{-- Bottos para mudar de carrousel, h-100(altura), top(margin top), star(margin left) ,ps(padding left/start), data-bs-target(a quem se refere, ou espera acao) --}}
                                <button class="carousel-control-prev h-100 top-50 position-absolute top-50 start-0 translate-middle ps-5" type='button' data-bs-target="#carouselCards"
                                    data-bs-slide="prev">
                                        <span arial-hidden='true'><img src="{{ asset('./icons/flecha-esquerda.png' )}}" alt="Seta Esquerda" width="20" height="20"></span>
                                        <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next h-100 top-50 position-absolute top-50 start-100 translate-middle pe-5" type='button' data-bs-target="#carouselCards"
                                    data-bs-slide="next">
                                    <span arial-hidden='true'><img src="{{ asset('./icons/flecha-direita.png' )}}" alt="Seta Esquerda" width="20" height="20"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Separando Por Categorias e as 5 primeiras --}}
                @foreach ($tipos_prod->where('id_categoria', '<=', 5) as $separador)
                    <div class="my-2">
                        <div class="my-4 p-4 rounded" style="background-color:rgb(255, 246, 246) ">
                            <div class="row">
                                <div class="col-12 text-left ms-3 fs-4">
                                    <img src="{{ asset('./icons/'. $separador->icone) }}" alt="{{ $separador->categoria }}" width="40" height="40" class="mb-1">
                                    {{ $separador->categoria }}
                                    <hr class="mt-0 ">
                                </div>
                            </div>
                            <div class="row text-center">
                                <div id="carouselCards{{$separador->categoria}}" class="carousel slide">
                                    <div class="carousel-inner">
                                        <span hidden>{{$x = 0}}</span>
                                        @foreach ($separador->produtos as $produto)
                                            @if ($x % 5 == 0)
                                                <div class="carousel-item {{ $x == 0 ? 'active' : '' }}">
                                            @endif
                                            <a href="produto/{{ $produto->id_produto }}">
                                                <div class="card mx-1 col-sm-2 d-inline-block cards-shadow font">
                                                    <div class="card-head">
                                                        <div class="card_img">
                                                            <x-verifica-img class="card-img-top h-100 card_zoom" :img="$produto->imagens->first()" storage='img_produtos_users' />
                                                        </div>
                                                        <div class="card-body font">
                                                            <h5 class="card-title text-dark font">{{ $produto->produto }}</h5>
                                                            <p class="card-text text-dark">R$: {{ $produto->preco }}</p>
                                                        </div>
                                                        <div class="card-footer text-secondary font ">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        {{ $produto->vendedor->endereco->ceps->cidade}}/
                                                        {{ $produto->vendedor->endereco->ceps->sigla }}
                                                    </div>
                                                    </div>
                                                </div>
                                            </a>
                                            
                                            <span hidden>{{$x++}}</span>
                                            @if ($x % 5 == 0)
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev top-50 position-absolute start-0 translate-middle ps-5" type='button' data-bs-target="#carouselCards{{$separador->categoria}}" data-bs-slide="prev">
                                        <span arial-hidden='true'><img src="{{ asset('./icons/flecha-esquerda.png' )}}" alt="Seta Esquerda" width="20" height="20"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next top-50 position-absolute start-100 translate-middle pe-5" type='button' data-bs-target="#carouselCards{{$separador->categoria}}" data-bs-slide="next">
                                        <span arial-hidden='true'><img src="{{ asset('./icons/flecha-direita.png' )}}" alt="Seta Esquerda" width="20" height="20"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    {{-- Fim Cards --}}
@endsection
