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
        <nav class="navbar navbar-expand-lg text-light bg-dark" >
            <div class="container-fluid">
                {{-- Navbar-Brand para nome  --}}
                <a class="navbar-brand text-light" href="/">
                    <img src="{{ asset('img/icon.webp') }}" title="HOME" width="30" height="24"
                        class="d-inline-block align-top logo img-size-logo-home" alt="Laravel">
                    Home
                </a>
                {{-- Navbar-toggle para plug -in de recolhimento  --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                {{-- Navbar-collapse para agrupar e ocultar conteudo de barras de navegacao --}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    {{-- navbar-nav navegacao completa e leve --}}
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            {{-- active para um destaque na Home(indicar em q lugar vc esta) --}}
                            <a class="nav-link active text-light" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-light" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown ">
                            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-info" type="submit"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    
                </div>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                    <li class="nav-item">
                        <a href="#" class="nav-link text-light" aria-current="page">Sign In</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-light" aria-current="page">Sign Up</a>
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
