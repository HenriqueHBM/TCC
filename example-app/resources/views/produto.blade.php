@extends('layouts.app')
@section('title', 'Produto')
@section('content')

<main>
    <div class="container " >
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Postado em</th>
                    <th>Vencimento</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $linha->produto }}</td>
                    <td>{{ $linha->preco }}</td>
                    <td>{{ $linha->descricao }}</td>
                    <td>{{ data_format($linha->created_at) }}</td>
                    <td>{{ data_format($linha->data_vencimento) }}</td>
                    <td>{{$linha->tipo_produto->tipo}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</main>
@endsection