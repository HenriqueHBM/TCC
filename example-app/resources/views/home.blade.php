@extends('layouts.app')
@section('title', 'Home')
@section('content')
    {{-- Carrouse de Imagens --}}
    <div id="carouselSite" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            {{-- Navegacao em barras --}}
            <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            {{-- deixar 1º banner ativo --}}
            <div class="carousel-item active">
                {{-- img-fluid(aplica max-width e max-height) --}}
                <img src=img/img01.jpg class=" img-fluid w-100">
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
        {{-- Geral --}}
        <div class="container-fluid my-4">
            <div class="ms-2">
                <div class="row">
                    <div class="col-12 text-left ">
                        <i class="fa-solid fa-utensils d-inline fs-4"> Geral</i>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    @foreach ($linhas as $item)
                        <div class="card text-center mx-1 col-md-2 p-0 ">
                            <div style="height: 220px;">
                                <img src="img/preto.jpg" class="card-img-top h-100">
                            </div>
                            <div class="card-body ">
                                <h5 class="card-title ">{{ $item->produto }}</h5>
                                <p class="card-text ">R$: {{ $item->preco }}</p>
                                {{-- Card como link --}}
                                <a href="produto/{{ $item->id_produto }}" class="stretched-link"></a>
                            </div>
                            <div class="card-footer text-muted ">
                                {{ $item->dt_vencimento }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Comidas --}}
        <div class="container-fluid my-3 py-3 ">
            <div class="ms-2">

                <div class="row">
                    <div class="col-12 text-left">
                        <i class="fa-solid fa-bowl-rice fs-4"> Comidas</i>
                        <hr>
                    </div>
                </div>
                <div class="row ">
                    @foreach ($linhas->where('tipo_alimentacao', 'Comida') as $item)
                        <div class="card text-center mx-1 col-md-2 p-0 ">
                            <div style="height: 220px;">
                                <img src="img/preto.jpg" class="card-img-top h-100">
                            </div>
                            <div class="card-body ">
                                <h5 class="card-title ">{{ $item->nome }}</h5>
                                <p class="card-text ">R$: {{ $item->preco }}</p>
                                {{-- Card como link --}}
                                <a href="produto/{{ $item->id_produto }}" class="stretched-link"></a>
                            </div>
                            <div class="card-footer text-muted ">
                                {{ $item->dt_vencimento }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Bebidas --}}
        <div class="container-fluid my-3 py-3">
            <div class="ms-2">
                <div class="row">
                    <div class="col-12 text-left ">
                        <i class="fa-solid fa-champagne-glasses fs-4 "> Bebidas</i>
                        <hr>
                    </div>
                </div>
                <div class="row ">
                    @foreach ($linhas->where('tipo_alimentacao', 'Bebida') as $item)
                        <div class="card text-center mx-1 col-md-2 p-0 ">
                            <div style="height: 220px;">
                                <img src="img/preto.jpg" class="card-img-top h-100">
                            </div>
                            <div class="card-body ">
                                <h5 class="card-title ">{{ $item->nome }}</h5>
                                <p class="card-text ">R$: {{ $item->preco }}</p>
                                {{-- Card como link --}}
                                <a href="produto/{{ $item->id }}" class="stretched-link"></a>
                            </div>
                            <div class="card-footer text-muted ">
                                {{ $item->dt_vencimento }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    {{-- Fim Cards --}}
@endsection
