@extends('layouts.app')
@section('title', 'Home')
@section('content')
    {{-- Carrouse de Imagens --}}
    <div id="carouselSite" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselSite" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src=img/img01.jpg class="d-block img-fluid w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Procure Ofertas Facilmente</h5>
                    <p>E espere o pedido em sua casa</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/img02.jpg" class="d-block img-fluid w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Preços acessiveis</h5>
                    <p>E nada estragado</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="img/img03.jpeg" class="d-block img-fluid w-100">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Tudo em um só lugar</h5>
                    <p>Rapido e fácil</p>
                </div>
            </div>
        </div>
    </div>
    {{-- Geral --}}
    <div class="container-fluid my-3 py-3 ">
        <div class="row ">
            <div class="col-12 text-left ">
                <h3>Geral</h3>
            </div>
        </div>
        <div class="row">
            <div class="card text-center mx-2" style="width: 13rem;">
                <img src="img/McLanche.webp" class="card-img-top  ">
                <div class="card-body">
                    <h5 class="card-title ">Mc Feliz</h5>
                    <p class="card-text ">R$: 10.70</p>
                </div>
            </div>
            <div class="card text-center mx-2" style="width: 13rem;">
                <img src="img/vinho.png" class="card-img-top  ">
                <div class="card-body">
                    <h5 class="card-title ">Vinho</h5>
                    <p class="card-text ">R$: 39.99</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Comidas --}}
    <div class="container-fluid my-3 py-3 ">
        <div class="row ">
            <div class="col-12 text-left ">
                <h3>Comidas</h3>
            </div>
        </div>
        <div class="row">
            <div class="card text-center mx-3" style="width: 13rem;">
                <img src="img/McLanche.webp" class="card-img-top  ">
                <div class="card-body">
                    <h5 class="card-title ">Mc Feliz</h5>
                    <p class="card-text ">R$: 10.50</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Bebidas --}}
    <div class="container-fluid my-3 py-3">
        <div class="row ">
            <div class="col-12 text-left ">
                <h3>Bebidas</h3>
            </div>
        </div>
        <div class="row">
            <div class="card text-center" style="width: 13rem;">
                <img src="img/vinho.png" class="card-img-top  ">
                <div class="card-body">
                    <h5 class="card-title ">Vinho</h5>
                    <p class="card-text ">R$: 39.99</p>
                </div>
            </div>
        </div>
    </div>
@endsection
