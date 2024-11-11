@extends('layouts.app')
@section('title', 'Meus Eventos')
@section('content')
    <x-mensagem />
    <main style="padding:100px">
        <div class="container mt-4 ">
            <div class="row">
                <h3>Meus Eventos</h3>
            </div>
            <br>
            <div class="row">
                <div class="d-flex">
                    @if (count($meus_eventos) <= 0)
                        <div>
                            Você não possui nenhum evento anunciado.
                        </div>
                    @endif
                    @foreach ($meus_eventos as $meus_eventos)
                        <div class="card mb-3 w-100" style="height: 200px">
                            <div class="row">
                                <div class="col-md-4">
                                    <x-verifica-img  class=" rounded-start w-100"
                                        :img="$meus_eventos" storage='banners_eventos' height='197' alt='imagem do seu evento' />
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $meus_eventos->titulo_evento }}</h5>
                                        <p class="card-text">
                                            {{ $meus_eventos->descricao }}
                                        </p>
                                        <p class="card-text">
                                            <small class="text-body-secondary">
                                                Última Atualização: {{ data_format($meus_eventos->updated_at) }}
                                            </small>
                                        </p>
                                        <!-- Onde deveria ficar o título-->
                                        <a href="eventos/visualizar_evento/{{ $meus_eventos->id_evento }}" class="stretched-link"
                                            title="{{ $meus_eventos->titulo_evento }}"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 align-content-center  ">
                            <a href="/meus_eventos/{{ $meus_eventos->id_evento }}/editar_evento" alt='editar' class="btn btn-sm border border-0">
                                <img src="{{ asset('icons/lapis.png') }}" title="Editar Evento" width="60" height="60">
                            </a>
                            <button class="btn btn-sm excluir border border-0 " data-evento='{{ $meus_eventos->titulo_evento }}' data-id="{{ $meus_eventos->id_evento }}" > 
                                <img src="{{ asset('icons/excluir.png') }}" title="Excluir Evento" width="60" height="60">
                            </button>
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
                    <h3>Desenha Realmente Excluir Esse Evento?</h3>
                    <div class="row">
                        <div id="evento_excluir" class="h4"></div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button>
                    {{-- Evitando Mensagem de Erro --}}
                    
                        <button class="btn btn-danger" id="save_excluir">Confirmar</button>
                    
                </div>
            </div>
        </div>
    </div>



    <script>
        $(document).on('click', '.excluir', function(e) {
            e.preventDefault();
            $('#evento_excluir').text($(this).data('evento'));
            $('#save_excluir').val($(this).data('id'));
            $('#excluirModal').modal('show');
        })
        $(document).on('click', '#save_excluir', function() {
            let id = $(this).val();
            $.ajax({
                type: 'POST',
                url: `/meus_eventos/${id}/excluir`,
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
