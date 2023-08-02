<!doctype html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    {{-- titulo da pag --}}
    <title>@yield('title')</title>
    <!-- Icone nas telas -->
    <link rel="icon" href="{{ url('img/icon.webp') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('site/style.css') }}">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    {{-- FontAwsome/ Icons --}}
    <script src="https://kit.fontawesome.com/b1621cc4d4.js" crossorigin="anonymous"></script>

</head>

<body class="bg-light">
    <header>
        <nav class="navbar navbar-expand-lg text-light bg-dark ">
            <div class="container-fluid">
                {{-- Navbar-Brand para nome do projeto --}}
                <a class="navbar-brand text-light " href="/">
                    {{-- Logo do site --}}
                    <img src="{{ asset('img/icon.webp') }}" title="Voltar ao Início" width="30" height="24"
                        class="img-size-logo-home me-2 logo ">
                    Home
                </a>
                <div class="w-50 justify-content-start">
                    <form class="d-flex" role="search">
                        {{-- mx(margin left e right),  --}}
                        <input type="text"
                            class="mx-2 border-bottom-3 border-danger border-top-0 border-end-0 border-start-0 bg-dark text-light w-100 tirar_bordas"
                            placeholder="Pesquisar">
                        <!-- <input class="form-control btn btn-sm btn-light  me-2" type="search" placeholder="Search" aria-label="Search"> -->
                        <button class="btn btn-md btn-outline-light border-0" type="submit"><i
                                class="fa-sharp fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                {{-- toggle(mudar de estado == on/off) , bs-target(de onde deve vir a informacao/pedido)--}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                    {{-- span para surgir botao quando diminuir tamanho da tela --}}
                    <span><i class="fa-solid fa-bars text-light "></i></span>
                </button>
                {{-- Navbar-collapse para agrupar e ocultar conteudo de barras de navegacao, jsutify-content( para deixar itens alinhados a direita) --}}
                <div class="collapse navbar-collapse justify-content-end"
                    id="navbarSupportedContent">
                    {{-- Navbar-nav para navegação leve(menus suspensos)  --}}
                    <ul class="navbar-nav ">
                        <li class="nav-item dropdown ">
                            <a class="nav-link active dropdown-toggle text-light" href="#" role="button"
                                data-bs-toggle="dropdown">
                                Distribuição
                            </a>
                            <ul class="dropdown-menu ">
                                <li><a class="dropdown-item " href="minhas_entregas">Minhas Entregas</a></li>
                                <li><a class="dropdown-item " href="/criar_distribuicao">Criar Distribuição</a></li>
                                <li>
                                    {{-- Linha separando as distribuicao --}}
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item " href="/distribuicoes">Olhar Distribuições</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light" aria-current="page">Entrar</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-light" aria-current="page">Cadastrar</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
    @yield('content')
</body>

</html>
