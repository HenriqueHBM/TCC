@extends('layouts.app')
@section('title', 'Produto')
@section('content')
    <style>
        * {
            box-sizing: border-box;
        }

        /* Position the image container (needed to position the left and right arrows) */
        .container {
            position: relative;
        }

        /* Hide the images by default */
        .mySlides {
            display: none;
        }

        /* Add a pointer when hovering over the thumbnail images */
        .cursor {
            cursor: pointer;
        }

        /* Next & previous buttons */
        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 40%;
            width: auto;
            padding: 16px;
            margin-top: -50px;
            color: white;
            font-weight: bold;
            font-size: 20px;
            border-radius: 0 3px 3px 0;
            user-select: none;
            -webkit-user-select: none;
        }

        /* Position the "next button" to the right */
        .next {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover,
        .next:hover {
            background-color: rgba(0, 0, 0, 0.8);
        }

        /* Number text (1/3 etc) */
        .numbertext {
            color: #f2f2f2;
            font-size: 12px;
            padding: 8px 12px;
            position: absolute;
            top: 0;
        }

        /* Container for image text */
        .caption-container {
            text-align: center;
            background-color: #222;
            padding: 2px 16px;
            color: white;
        }

        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        /* Six columns side by side */
        .column {
            float: left;
            width: 16.66%;
        }

        /* Add a transparency effect for thumnbail images */
        .demo {
            opacity: 0.6;
        }

        .active,
        .demo:hover {
            opacity: 1;
        }
    </style>

    <script>
        let slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("demo");
            let captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }
    </script>
    <main>
        <div class="container mt-4 d-flex  border border-primary">
            <div class="flex-1 border border-success">
                <!-- Container for the image gallery -->
                <div class="container flex-grow">

                    <!-- Full-width images with number text -->
                    @foreach ($linha->imagens as $img)
                        <div class="mySlides">
                            <div class="numbertext">{{ $loop->index }} / {{ $linha->imagens->count() }}</div>
                            <img src="{{ asset('img_folders/' . $img->imagem) }}" height="500" width="500">
                        </div>
                    @endforeach

                    <!-- Next and previous buttons -->
                    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                    <a class="next" onclick="plusSlides(1)">&#10095;</a>
                    

                    <!-- Thumbnail images -->
                    <div class="row justify-content-between  border border-danger f-flex">
                        @foreach ($linha->imagens as $img)
                            <div class="column">
                                <img class="demo cursor" src="{{ asset('img_folders/' . $img->imagem) }}" height="100"
                                    width="100" onclick="currentSlide(1)" alt="The Woods">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class=" flex-1 ps-3 border border-success">
                <h1 class="my-2">{{ $linha->produto }}</h1>
                <h4>R$: {{ $linha->preco }}</h4>
                <h4>Data de Vencimento: {{ data_format($linha->data_vencimento) }}</h4>
                <h4>Enviado por: {{ $linha->vendedor->nome }}</h4>
                <div>
                    {{ $linha->descricao }}
                </div>
            </div>
        </div>
    </main>
@endsection
