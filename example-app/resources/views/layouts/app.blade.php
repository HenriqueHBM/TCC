<!doctype html>
<html lang="pt-br">

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

<body>
    <header class="">
        <nav class="navbar navbar-expand-xl text-light bg-dark fixed-top  " >
            <div class="container-fluid">
                {{-- Navbar-Brand para nome do projeto --}}
                <a class="navbar-brand text-light" href="/">
                    {{-- Logo do site --}}
                    <img src="{{ asset('img/icon.webp') }}" title="HOME" width="30" height="24"
                        class="d-inline-block align-top logo img-size-logo-home me-2" alt="Laravel">
                    Home
                </a>
                {{-- Navbar-toggle para plug -in de recolhimento  --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                {{-- Navbar-collapse para agrupar e ocultar conteudo de barras de navegacao --}}
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <form class="d-flex" role="search">
                        <input type="text"
                            class="ms-2 me-2 border-bottom-3 border-danger border-top-0 border-end-0 border-start-0 bg-dark text-light"
                            placeholder="Pesquisar">
                        <!-- <input class="form-control btn btn-sm btn-light  me-2" type="search" placeholder="Search" aria-label="Search"> -->
                        <button class="btn btn-md btn-outline-info" type="submit"><i
                                class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                    </form>

                </div>
                {{-- Navbar-nav para navegação leve(menus suspensos)  --}}
                <ul class="navbar-nav ">
                    <li class="nav-item dropdown ">
                        <a class="nav-link active dropdown-toggle text-light" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Distribuição
                        </a>
                        <ul class="dropdown-menu">
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
        </nav>
    </header>
    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
    @yield('content')
</body>

</html>
