@extends('layouts.app')
@section('title', 'Eventos')
@section('content')
    <main>
        <div class="container mt-5">
            <div class="row justify-content-between">
                <div class="col-md-3 mb-2">
                    <h3>{{ $evento->titulo_evento }}</h3>
                    

                </div>
            </div>
            <div class="d-flex" style="border: 2px solid #000000; border-radius: 10px;">
                <div class="d-inline col-md-6" >   
                    <img src="{{ url('storage/banners_eventos/' . $evento->imagem) }}" class="img-fluid rounded-start h-100"
                        alt="Banner Evento">
                </div>
                <div class="d-inline col-md-6 ms-3">
                    <br><h4> 📌 {{ $evento->endereco->ceps->cidade }}, {{ $evento->endereco->ceps->sigla }}</h4>
                    <br><h4> 📪 Rua {{ $evento->endereco->rua }}. Bairro {{ $evento->endereco->bairro }}. {{ $evento->endereco->numero_residencia }}. {{$evento->endereco->complemento }}.</h4>
                    <br><h4> 📅 {{ ($evento->data) }}. 🕗 Início ás {{ $evento->horario_inicio}}h, término ás {{$evento->horario_fim}}h.</h4>
                </div>
                    
            </div>
            <br><h4> 📃 {{ $evento->descricao}}</h4>
        </div>
    </main>

@endsection
