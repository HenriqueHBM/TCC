@extends('layouts.app')
@section('title', 'Distribuições')
@section('content')

    <main>
        <div class="container mt-4" >
            @foreach ($tipos_prod as $separador)
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
                                                @if ($x == 0)
                                                    <div class="carousel-item active">
                                                @else
                                                    <div class="carousel-item">
                                                @endif
                                            @endif
                                            <a href="produto/{{ $produto->id_produto }}">
                                                <div class="card mx-1 col-sm-2 d-inline-block cards-shadow">
                                                    <div class="card-head">
                                                        <div class="card_img">
                                                            <x-verifica-img class="card-img-top h-100 card_zoom" :img="$produto->imagens->first()" storage='img_produtos_users' />
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title text-dark">{{ $produto->produto }}</h5>
                                                            <p class="card-text text-dark">R$: {{ $produto->preco }}</p>
                                                        </div>
                                                        <div class="card-footer text-secondary font_sm ">
                                                        <i class="fa-solid fa-location-dot"></i>
                                                        {{ $produto->vendedor->endereco->ceps->cidade}}
                                                        -
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
@endsection