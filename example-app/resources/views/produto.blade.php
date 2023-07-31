@extends('layouts.app')
@section('title', 'Produto')
@section('content')


<main role="main" >
    <div class="container " >
        <table class="table">
            <thead>
                <th>Nome</th>
                <th>Preço</th>
                <th>Descrição</th>
                <th>Postado em</th>
                <th>Vencimento</th>
            </thead>
            <tbody>
                <td>{{ $linha->produto }}</td>
                <td>{{ $linha->preco }}</td>
                <td>{{ $linha->descricao }}</td>
                <td>{{ $linha->created_at }}</td>
                <td>{{ $linha->data_vencimento }}</td>
            </tbody>
        </table>
    </div>
</main>
@endsection