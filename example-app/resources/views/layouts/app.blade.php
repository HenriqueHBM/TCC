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

<body style="background-color: #E7D7C1">
    <header class="p-2 fundo-red" >
        <nav class="navbar navbar-expand-lg text-light ">
            <div class="container-fluid">
                {{-- Navbar-Brand para nome do projeto --}}
                <a class="navbar-brand text-light " href="/">
                    {{-- Logo do site --}}
                    <img src="{{ asset('img/icon.webp') }}" title="Voltar ao Início" width="30" height="24"
                        class="img-size-logo-home me-2 logo ">
                    Home
                </a>
                <div class="w-50 justify-content-start">
                    <form class="d-flex" role="search" method="get" action="/distribuicoes">
                        {{-- mx(margin left e right),  --}}
                        <input type="text"
                            class="mx-2 py-2 px-3 w-100 border border-0 rounded-pill tirar_bordas "
                            placeholder="Pesquisar..." id="search" name="search">
                        <button class="btn btn-md btn-outline-light border-0" type="submit"><i
                                class="fa-sharp fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
                {{-- toggle(mudar de estado == on/off) , bs-target(de onde deve vir a informacao/pedido) --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent">
                    {{-- span para surgir botao quando diminuir tamanho da tela --}}
                    <span><i class="fa-solid fa-bars text-light "></i></span>
                </button>
                {{-- Navbar-collapse para agrupar e ocultar conteudo de barras de navegacao, jsutify-content( para deixar itens alinhados a direita) --}}
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    {{-- Navbar-nav para navegação leve(menus suspensos)  --}}
                    <ul class="navbar-nav ">
                        <li class="nav-item dropdown ">
                            <a class="nav-link active dropdown-toggle text-light" href="#" role="button"
                                data-bs-toggle="dropdown">
                                Distribuição
                            </a>
                            <ul class="dropdown-menu ">
                                <li><a class="dropdown-item " href="/minhas_entregas">Minhas Entregas</a></li>
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
                            <a href="#" class="nav-link text-light" aria-current="page">Cadastrar-se</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div id="page-container">
        <div id="content-wrap">
            <!-- all other page content -->
            @yield('content')
        </div>
        {{-- style="bottom: 0; width: 100%;"> --}}
        {{-- position-absolute top-100 w-100 --}}
        <footer class="footer fundo-brown text-center text-white" id="footer">
            <div class="container p-4">
                <section class="mb-4 ">
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                            class="fab fa-google"></i></a>

                    <!-- Instagram -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                            class="fab fa-instagram"></i></a>

                    <!-- Linkedin -->
                    <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                            class="fab fa-linkedin-in"></i></a>

                    <!-- Github -->
                    <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/HenriqueHBM/TCC" role="button"><i
                            class="fab fa-github"></i></a>
                </section>
                <section class="mb-4">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc pretium purus nec sapien rhoncus
                        laoreet.
                        Etiam sed nulla a nisl varius elementum id sit amet est. Nullam aliquet felis nec libero porta
                        accumsan laoreet et metus.
                        In nec arcu eu nunc tristique dictum. Fusce sit amet quam quis tellus semper commodo. Quisque
                        dictum
                        ut quam tincidunt rutrum.
                        Phasellus vulputate pellentesque arcu quis semper. Fusce vitae sagittis erat, placerat
                        consectetur
                        purus.
                    </p>
                </section>
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                &copy;Bom Dia Footer
                <a class="text-white" href="/">www.forlife.com.br</a>
            </div>
        </footer>

    </div>
    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
</body>


</html>
