<!doctype html>
<html lang="pt-br">

<head>
    {{-- titulo da pag --}}
    <title>@yield('title')</title>
    <!-- Icone nas telas -->
    <link rel="icon" href="{{ url('img/icon.webp') }}">
    <!-- Bootstrap modificavel -->
    <link rel="stylesheet" href="{{ asset('site/style.css') }}">

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    {{-- FontAwsome/ Icons --}}
    <script src="https://kit.fontawesome.com/b1621cc4d4.js" crossorigin="anonymous"></script>
</head>

<body>
  <div class="">
    @yield('content')
    <nav class="navbar navbar-expand-lg navbar-dark bg-gradient-primary ">
      
    </nav>
  </div>

    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
</body>

</html>
