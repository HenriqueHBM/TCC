@extends('layouts.app')
@section('title', 'Distribuições')
@section('content')

    <main>
        <div class="container " >
            {{-- {{ $search }} --}}
            <table class="table">
                
                <thead>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Descrição</th>
                    <th>Postado em</th>
                    <th>Vencimento</th>
                    <th>Categoria</th>
                </thead>
                <tbody>
                    @foreach ($distribuicoes as $produto)
                        <tr>
                            <td>{{ $produto->produto }}</td>
                            <td>{{ $produto->preco }}</td>
                            <td>{{ $produto->descricao }}</td>
                            <td>{{ $produto->created_at }}</td>
                            <td>{{ $produto->data_vencimento }}</td>
                            <td>{{$produto->tipo_produto->tipo}}</td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection