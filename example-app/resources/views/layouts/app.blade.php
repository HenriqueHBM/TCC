<!doctype html>
<html lang="pt-br">

<head>

  <title>@yield('title')</title>
  <!-- Não esta funcionanodo/ icone nas telas -->
  <link rel="shortcut icon"   href="{{ url('css/icon.webp') }}">
  <!-- Bootstrap modificavel -->
  <link rel="stylesheet" href="{{ asset('site/style.css') }}">

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

</head>

    <body>
    <h3>Layouts/App</h3>

    <script src="{{ asset('site/jquery.js') }}"></script>
    <script src="{{ asset('site/bootstrap.js') }}"></script>
    </body>
</html>