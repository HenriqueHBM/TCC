@extends('layouts.app')
@section('title', 'Tudo a Vida')
@section('content')
    {{-- Carrouse de Imagens --}}
    <div id="carouselSite" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            {{-- Navegacao em barras, #carouselSite passa ao id em que se refere, e slide-to, um valor ao referindo --}}
            <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            {{-- deixar 1º banner ativo --}}
            <div class="carousel-item active">
                {{-- img-fluid(aplica max-width e max-height) imagens de 1000x300px --}}
                <img src="img/img01.jpg" class=" img-fluid w-100">
                {{-- carroseul-caption para adicionar legendas --}}
                <div class="carousel-caption">
                    <h5>Procure Ofertas Facilmente</h5>
                    <p>E espere o pedido em sua casa</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/img02.jpg" class=" img-fluid w-100">
                <div class="carousel-caption">
                    <h5>Preços acessiveis</h5>
                    <p>E nada estragado</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/img03.jpeg" class=" img-fluid w-100">
                <div class="carousel-caption">
                    <h5>Tudo em um só lugar</h5>
                    <p>Rapido e fácil</p>
                </div>
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
    {{-- Cards --}}
    {{-- Ao adicionar .translate-middle-x, os elementos podem ser posicionados apenas na direção horizontal. --}}
    <div class="container position-absolute start-50 translate-middle-x ">
        {{-- Geral --}}
        <div class="my-4 p-4 bg-white rounded">
            <div class="row">
                <div class="col-12 text-left ms-3">
                    <i class="fa-solid fa-utensils d-inline fs-4 "> Geral</i>
                    <hr class="mt-0 me-3">
                </div>
            </div>
            <div class="row text-center">
                <div id="carouselCards" class="carousel ">
                    @foreach ($produtos as $produto)
                        @if ($loop->first)
                            <div class='carousel-item active'>
                        @else
                            <div class='carousel-item'>
                        @endif
                        @foreach ($produto as $item)
                            <div class="card text-center mx-1 col-sm-2 p-0 d-inline-block ">
                                <div class="card-head">
                                    <div style="height: 200px;">
                                        {{-- src="{{ asset('anexos_os/' . $anexo->arquivo) }}" --}}
                                        <img src="{{ asset('img_folders/' . $item->imagens->first()->imagem) }}" class="card-img-top h-100">
                                    </div>
                                </div>
                                <div class="card-body ">
                                    <h5 class="card-title ">{{ $item->produto }}</h5>
                                    {{-- card-text para textos --}}
                                    <p class="card-text ">R$: {{ $item->preco }}</p>
                                    {{-- Card como link --}}
                                    <a href="produto/{{ $item->id_produto }}" class="stretched-link"></a>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    @endforeach
                        <button class="carousel-control-prev h-100 top-50 position-absolute top-50 start-0 translate-middle ps-5" type='button' data-bs-target="#carouselCards"
                            data-bs-slide="prev">
                                <span arial-hidden='true'><i class="fa-solid fa-angles-left text-info fs-4" ></i></span>
                                <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next h-100 top-50 position-absolute top-50 start-100 translate-middle pe-5" type='button' data-bs-target="#carouselCards"
                            data-bs-slide="next">
                            <span arial-hidden='true'><i class="fa-solid fa-angles-right text-info fs-4" ></i></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                </div>
            </div>
        </div>

        {{-- Separando Por Categorias --}}
        @foreach ($tipos_prod as $separador)
            <div class="my-4 p-4 bg-white rounded">
                <div class="row">
                    <div class="col-12 text-left ms-3">
                        <i class="{{ $separador->icone }}"> {{$separador->tipo}}</i>
                        <hr class="mt-0 me-3">
                    </div>
                </div>
                <div class="row text-center">
                    <div id="carouselCards{{$separador->tipo}}" class="carousel ">
                        @foreach ($produtos as $produto)
                            @if ($loop->first)
                                <div class='carousel-item active'>
                            @else
                                <div class='carousel-item'>
                            @endif
                            @foreach ($produto as $item)
                                @if ($item->id_tipos_produtos == $separador->id_tipos_produtos )
                                    <div class="card text-center mx-1 col-sm-2 p-0 d-inline-block ">
                                        <div class="card-head">
                                            <div style="height: 200px;">
                                                {{-- src="{{ asset('anexos_os/' . $anexo->arquivo) }}" --}}
                                                <img src="{{ asset('img_folders/' . $item->imagens->first()->imagem) }}" class="card-img-top h-100">
                                            </div>
                                        </div>
                                        <div class="card-body ">
                                            <h5 class="card-title ">{{ $item->produto }}</h5>
                                            {{-- card-text para textos --}}
                                            <p class="card-text ">R$: {{ $item->preco }}</p>
                                            {{-- Card como link --}}
                                            <a href="produto/{{ $item->id_produto }}" class="stretched-link"></a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            </div>
                        @endforeach
                            <button class="carousel-control-prev h-100 top-50 position-absolute top-50 start-0 translate-middle ps-5" type='button' data-bs-target="#carouselCards{{$separador->tipo}}"
                                data-bs-slide="prev">
                                    <span arial-hidden='true'><i class="fa-solid fa-angles-left text-info fs-4" ></i></span>
                                    <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next h-100 top-50 position-absolute top-50 start-100 translate-middle pe-5" type='button' data-bs-target="#carouselCards{{$separador->tipo}}"
                                data-bs-slide="next">
                                <span arial-hidden='true'><i class="fa-solid fa-angles-right text-info fs-4" ></i></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- {{ print_r($produtos) }} prod --}}

    </div>


    {{-- Fim Cards --}}


@endsection
