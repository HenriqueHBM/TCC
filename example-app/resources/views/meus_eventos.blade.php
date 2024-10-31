@extends('layouts.app')
@section('title', 'Meus Eventos')
@section('content')
    <x-mensagem />
    <main style="padding:100px">
        <div class="container mt-4 ">
            <div class="row">
                <h3>Meus Produtos</h3>
            </div>
            <br>
            <div class="row">
                <div class="d-flex">
                    @if (count($eventos) <= 0)
                        <div>
                            Você Não Possui Nenhum Produto Anunciado.
                        </div>
                    @endif
                    @foreach ($eventos as $meus_eventos)
                        <div class="card mb-3 w-100 card_produto col-md-10">
                            <div class="row">
                                <div class="col-md-3">

                                    <!-- Aqui onmde deveria ficar a imagem -->
                                        
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $meus_eventos->meus_eventos }}</h5>
                                        <p class="card-text">
                                            {{ $meus_eventos->descricao }}
                                        </p>
                                        <p class="card-text">
                                            <small class="text-body-secondary">
                                                Última Atualização: {{ data_format($meus_eventos->updated_at) }}
                                            </small>
                                        </p>
                                        <!-- Onde deveria ficar o título-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 align-content-center  ">
                            <a href="/minhas_entregas/{{ $meus_eventos->id_evento }}/editar" alt='editar' class="btn btn-sm border border-0">
                                <img src="{{ asset('icons/lapis.png') }}" title="Editar Evento"
                                    width="60" height="60">
                            </a>
                            <button class="btn btn-sm editar border border-0 ">
                            </button>
                            <button class="btn btn-sm excluir border border-0 ">
                                <img src="{{ asset('icons/excluir.png') }}" title="Excluir Evento"
                                    width="60" height="60">
                            </button>
                        </div>
                    @endforeach
            </div>
        </div>
    </main>




    <script>
        $(document).on('click', '.excluir', function(e) {
            e.preventDefault();
            $('#excluirModal').modal('show');
        })
        $(document).on('click', '#save_excluir', function() {
            let id = $(this).data('id');
            $.ajax({
                type: 'POST',
                url: `/minhas_entregas/${id}/excluir`,
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(data) {
                    $('#mensg_sucesso').text('Excluido Com Sucesso');
                    $('#mensg_sucesso').prop('hidden', false);
                    $('#excluirModal').modal('toggle');

                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });

                    setTimeout(function() {
                        window.location.reload(true);
                    }, 1000);
                }
            })
        });
    </script>
@endsection
