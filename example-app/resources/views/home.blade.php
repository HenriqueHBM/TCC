@extends('layouts.app')
@section('title', 'Home')
@section('content')
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
@endsection
