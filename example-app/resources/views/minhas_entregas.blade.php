@extends('layouts.app')
@section('title', 'Meus Produtos')
@section('content')
    <x-mensagem />
    <main style="padding:100px">
        <div class="container mt-4 ">
            <div class="row">
                <h3>Meus Produtos</h3>
            </div>
            <br>
            <div class="row">
                @if (count($produtos) <= 0)
                <div>
                    Você Não Possui Nenhum Produto Anunciado.
                </div>
                @endif
                @foreach ($produtos as $produto)
                <div class="d-flex">
                            <div class="card mb-3 w-100 card_produto " style="height: 200px">
                                <div class="row">
                                    <div class="col-md-4">
                                        <x-verifica-img href="produto/{{ $produto->id_produto }}" class="rounded-start w-100" :img="$produto->imagens->first()" storage='img_produtos_users'  height='197' alt="Banner Evento" />

                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $produto->produto }}</h5>
                                            <p class="card-text">
                                                {{ $produto->descricao }}
                                            </p>
                                            <p class="card-text">
                                                <small class="text-body-secondary">
                                                    Última Atualização: {{ data_format($produto->updated_at) }}
                                                </small>
                                            </p>
                                            <a href="produto/{{ $produto->id_produto }}" class="stretched-link"
                                                title="{{ $produto->produto }}"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1 align-content-center  ">
                                <a href="/minhas_entregas/{{ $produto->id_produto }}/editar" alt='editar'
                                    class="btn btn-sm border border-0">
                                    <img src="{{ asset('icons/lapis.png') }}" title="Editar Produto" width="60"
                                        height="60">
                                </a>
                                <button class="btn btn-sm editar border border-0 ">
                                </button>
                                <button class="btn btn-sm excluir border border-0 " data-produto='{{ $produto->produto }}' data-id='{{ $produto->id_produto }}'>
                                    <img src="{{ asset('icons/excluir.png') }}" title="Excluir Produto" width="60"
                                        height="60">
                                </button>
                            </div>
                        </div>
                    @endforeach
            </div>
        </div>
    </main>
    <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <h3>Desenha Realmente Excluir Esse Produto?</h3>
                    <div class="row">
                        <div id="produto_excluir" class="h4"></div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                    {{-- Evitando Mensagem de Erro --}}
                    @if (count($produtos) > 0)
                        <button class="btn btn-danger" id="save_excluir"
                            >Confirmar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on('click', '.excluir', function(e) {
            e.preventDefault();
            $('#produto_excluir').text($(this).data('produto'));
            $('#save_excluir').val($(this).data('id'));
            $('#excluirModal').modal('show');
        })
        $(document).on('click', '#save_excluir', function() {
            let id = $(this).val();
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
