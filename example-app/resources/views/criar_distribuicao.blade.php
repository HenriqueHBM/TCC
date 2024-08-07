@extends('layouts.app')
@section('title', 'Criar Distribuição')
@section('content')


    <main>
                                    <!-- top, right, bottom, left-->
        <form method="POST" style = "margin:50px 200px 0px 200px; border-style: solid; border-radius: 7px; box-shadow: -5px 5px 5px 0px #ada292;" >
            
            <div style="margin: 20px 50px 20px 50px">
                <div class="row mt-4">
                    <!-- Produto (nome) -->
                    <div class="col col-md-6">
                        <x-label for="nome" :value="__('Produto')" />

                        <x-input id="produto_nome" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                            required autofocus />

                    </div>

                    {{-- imagem--}}
                    <div class="col col-md-6">
                        <x-label for="imagem" :value="__('Imagem do produto')" />

                        <x-input id="imagem" class="block mt-1 w-full" type="file" name="imagem"
                            :value="old('file')" required />
                    </div>
                </div>

                <div class="row mt-4">
                    <!-- Preço -->
                    <div>
                        <x-label for="preco" :value="__('Preço')" />

                        <x-input id="preco" class="block mt-1 w-full" type="number" name="preco" :value="old('number')"
                            required />
                    </div>
                </div>

                <div class="row mt-4">
                    {{-- Quantidade (limite) --}}
                    <div class="col col-md-6">
                        <x-label for="quantidade" :value="__('Quantidade (limite)')" />

                        <x-input id="qauntidade" class="block mt-1 w-full" type="number" name="quantidade" :value="old('number')"
                            required />
                    </div>

                    {{-- Data de vencimento--}}
                    <div class="col col-md-6">
                        <x-label for="data_vencimento" :value="__('Data de Vencimento')" />

                        <x-input id="data_vencimento" class="block mt-1 w-full" type="date" name="data_vencimento"
                            :value="old('data_vencimento')" required />
                    </div>
                </div>

                <div class="row mt-4">
                    {{-- Descrição --}}
                    <div>
                        <x-label for="descricao" :value="__('Descrição')" />

                        <x-input id="descricao" class="block mt-1 w-full" type="text" name="descricao" :value="old('descricao')"
                            required />
                    </div>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </div>
        </form>
    </main>
@endsection
