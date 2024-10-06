@extends('layouts.app')
@section('title', 'Minhas Entregas')
@section('content')
    <main style="padding:100px">
        <div class="container mt-4 ">
            <div class="row">
                <h3>Meus Produtos</h3>
            </div>
            <div class="row">
                <div>
                    @foreach ($produtos as $produto)
                        <div class="card mb-3 w-100 card_produto">
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{ asset('img_produtos_users/' . $produto->imagens->first()->imagem) }}"
                                        class=" rounded-start " alt="Banner Evento" width="300" height="200">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $produto->produto }}</h5>
                                        <p class="card-text">
                                            {{ $produto->descricao }}
                                        </p>
                                        <p class="card-text">
                                            <small class="text-body-secondary">
                                                Última Atualização: {{ $produto->updated_at }}
                                            </small>
                                        </p>
                                    <a href="produto/{{ $produto->id_produto }}" class="stretched-link" title="{{ $produto->produto }}"></a>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                        <a href="#" class="btn p-0 z-2">
                                            <img src="{{ asset('icons/lapis.png') }}" alt="editar" title="Editar Produto" width="60" height="60" >
                                        </a>
                                        <a href="#" class="btn p-0 z-2">
                                            <img src="{{ asset('icons/excluir.png') }}" alt="editar" title="Editar Produto" width="60" height="60" >
                                        </a>
                                    {{-- <img src="{{ asset('icons/excluir.png') }}" alt="editar" title="Editar Produto" width="20" height="20"> --}}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
