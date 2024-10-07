<!doctype html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8" />
    {{-- titulo da pag --}}
    <title>@yield('title')</title>
    <!-- Icone nas telas -->
    <link rel="icon" href="{{ asset('img/logoForLife.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('site/style.css') }}">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    {{-- FontAwsome/ Icons  Deixar de usar --}}
    {{-- <script src="https://kit.fontawesome.com/b1621cc4d4.js" crossorigin="anonymous"></script> --}}

    {{-- Fonte dos Textos --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">

    {{-- Assinatura JsPdf --}}
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>

<body style="background-color: #E7D7C1">
    <header class="p-2 fundo-red card_produto">

        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                {{-- Navbar-Brand para nome do projeto --}}
                <a class="navbar-brand text-light " href="/">
                    {{-- Logo do site --}}
                    <img src="{{ asset('img/logoForLife.png') }}" title="Voltar ao Início" width="40" height="40"
                        class="me-2  " alt="Logo">
                    Home
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span><i class="fa-solid fa-bars text-light"></i></span>
                </button>
                {{-- Navbar-collapse para agrupar e ocultar conteudo de barras de navegacao, jsutify-content( para deixar itens alinhados a direita) --}}
                <div class="collapse navbar-collapse justify-content-between " id="navbarSupportedContent">

                    <div class="navbar-nav ">
                        <a href="/distribuicoes" class="nav-link text-light">Distribuições</a>
                        <a href="/eventos" class="nav-link text-light">Eventos</a>
                    </div>

                    {{-- Campo de Pesquisa --}}
                    <div class="navbar-nav w-50 d-flex">
                        <form class=" flex-fill " role="search" method="get" action="/distribuicoes">
                            <div class="form-row">
                                <input type="text" class=" p-2 rounded-pill tirar_bordas w-75"
                                    placeholder="Pesquisar..." id="search" name="search">

                                <button class="btn btn-md btn-outline-light border-0" type="submit">
                                    <img src="{{ asset('icons/lupa.png') }}" alt="lupa de pesquisa" width="20" height="20">
                                    <i class="fa-sharp fa-solid fa-magnifying-glass "></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="navbar-nav">
                        @auth
                            <a href="/criar_distribuicao" class="nav-link text-light">Anunciar</a>
                            <button class="btn border-0 btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <img src="{{ asset('icons/menu.png') }}" alt="menu" width="20" height="20">
                            </button>
                        @else
                            <a href="/login" class="nav-link text-light">Anunciar</a>
                        @endauth
                        @guest
                            <a href="/login" class="nav-link text-light">Entrar</a>
                            <a href="/register" class="nav-link text-light">Cadastrar-se</a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div id="page-container">
        <div id="content-wrap">
            <!-- all other page content -->
            @yield('content')
            @auth
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header mt-2">
                        <h5 id="offcanvasRightLabel">Ola {{ Auth::user()->nome }} &#128512;</h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <hr class="mt-0">
                    <div class="offcanvas-body">
                    <ul>
                        <li class="h4 mb-3">
                            <a href="/perfil" class="nav-link ">Perfil</a>
                        </li>
                        <li class="h4 mb-3">
                            <a href="/minhas_entregas" class="nav-link ">Minhas Entregas</a>
                        </li>
                        <li class="h4 mb-3">
                            <a href="/meus_eventos" class="nav-link ">Meus Eventos</a>
                        </li>
                    </ul>
                    </div>
                    <hr>
                    <div class="p-2 pt-0">
                        <form action="/logout" method="post">
                            @csrf
                            <a href="/logout" class="nav-link p-2 btn bg-danger text-light" onclick="event.preventDefault(); this.closest('form').submit();" >Sair</a>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
        {{-- style="bottom: 0; width: 100%;"> --}}
        {{-- position-absolute top-100 w-100 --}}
        <footer class="footer fundo-brown text-center text-white" id="footer">
            <div class="container p-4">
                <section class="mb-4 ">
                    <a class="btn btn-light btn-floating m-1" href="mailto:forLife@gmail.com" role="button">
                        <img src="{{ asset('./icons/google.png' )}}" alt="Goggle" width="20" height="20">
                    </a>

                    <!-- Instagram -->
                    <a class="btn btn-light btn-floating m-1" href="#!" role="button">
                        <img src="{{ asset('./icons/instagram.png' )}}" alt="Goggle" width="20" height="20">
                    </a>

                    <!-- Linkedin -->
                    <a class="btn btn-light btn-floating m-1" href="#!" role="button">
                        <img src="{{ asset('./icons/linkedin.png' )}}" alt="Goggle" width="20" height="20">
                    </a>

                    
                </section>
                <section class="mb-4">
                    <p>
                        A ForLife é um web site de venda e doação de produtos alimentícios que seriam descartados e desperdiçados, utilizando preços acessíveis em compensação. 
                        <br>
                        O site emprega, para a praticidade, o modelo “marketplace”, onde os próprios estabelecimentos divulgam seus produtos através da nossa plataforma.
                        <br>
                        Para sua realização, foram utilizados ferramentas que se destacam por suas funcionalidades e facilidade.
                    </p>
                </section>
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                &copy;ForLife
            </div>
        </footer>

    </div>
    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
</body>


</html>
