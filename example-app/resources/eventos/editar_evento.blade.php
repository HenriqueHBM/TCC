@extends('layouts.app')
@section('title', 'Editar Produto')
@section('content')
    <x-mensagem />
    <main class="main">
        <div class="container bg-light card-produto rounded-2 p-3" style="width: 600px">
            <form action="" method="POST" id="editForm">
                @csrf
                <div class="row pt-3 text-center">
                    <h4>Editar Evento</h4>
                </div>
                <hr>
                @if (count($produto->imagens) > 0)
                    <div class="row mt-3 text-center justify-content-center">
                        Max. 5
                        <div class="from-group">
                            <div class="block mt-1 w-full" id="image-preview">
                                @foreach ($produto->imagens as $img)
                                    <img src="{{ url('storage/img_produtos_users/' . $img->imagem) }}"
                                        class="rounded card_produto" width="105" height="110"
                                        alt="{{ $produto->produto }}">
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row mt-3 text-center justify-content-center">
                        <div class="from-group">
                            <div class="block mt-1 w-full" id="image-preview">
                            </div>
                        </div>
                    </div>
                @endif
                <input type="file" hidden multiple id="show_img" name="show_img[]">

                <div class="row mt-3">
                    <div class="form-group text-center">
                        @if (count($produto->imagens) < 5)
                            <label class="btn btn-success" for='show_img'
                                title='(Precisa selecionar todas as imagens que deseja em uma unica vez)'>Adicionar
                                Imagen(s)</label>
                        @endif
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="produto" class="form-label">Produto</label>
                        <input type="text" name="produto" id="produto" class="form-control"
                            value='{{ $produto->produto }}'>
                        <p class="alert error_produto alert-danger" role="alert" hidden></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="number" id="preco" name="preco" class="form-control"
                            value='{{ $produto->preco }}'>
                        <p class="alert error_preco alert-danger" role="alert" hidden></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="qtde" class="form-label">Quantidade(Limite)</label>
                        <input type="text" name="qtde" id="qtde" class="form-control"
                            value='{{ $produto->qtde }}'>
                        <p class="alert error_qtde alert-danger" role="alert" hidden></p>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="dt_vencimento" class="form-label">Data de Vencimento</label>
                        <input type="date" id="dt_vencimento" name="dt_vencimento" class="form-control"
                            value='{{ $produto->data_vencimento->format('Y-m-d') }}'>
                        <p class="alert error_dt_vencimento alert-danger" role="alert" hidden></p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class=" form-group">
                        <textarea name="descricao" id="descricao" cols="30" rows="8" class="form-control">{{ $produto->descricao }}</textarea>
                    </div>
                </div>
                <hr>
                <div class="row px-3 py-1 justify-content-between">
                    <a href="/minhas_entregas" class="btn btn-warning col-md-4">Voltar</a>
                    <button class="btn btn-primary col-md-4 save_edit" id="save_edit">Salvar Alteração</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        $('#show_img').change(function(e) {
            const maxImg = 5;
            let files = e.target.files;
            // Limpando as antigas imagens
            $('#image-preview').html('')
            // Verificação de quantidade de imagens adc
            if (files.length > 5) {
                alert(`Você pode selecionar no máximo ${maxImg} imagens.`);
                return;
            } else {
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    let reader = new FileReader();

                    reader.onload = function(e) {
                        let img = $("<img src='" + e.target.result +
                            "' width='105' height='110' class='card_produto rounded mx-1' />");
                        $('#image-preview').append(img);
                    };

                    reader.readAsDataURL(file);
                }
            }
        });
        $(document).on('click', '#save_edit', function(e) {
            e.preventDefault();
            var formData = new FormData($('#editForm')[0]);
            $.ajax({
                type: 'post',
                url: `editar/save_editar`,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.error){
                        setTimeout(function() {
                            $.each(data.error, function(index, element) {
                                $('.error_' + index).prop('hidden', false);
                                $('.error_' + index).text(element);
                            });
                        }, 100);
                    }else{
                        $('#mensg_sucesso').text('Editado Com Sucesso');
                        $('#mensg_sucesso').prop('hidden', false);
                        //Funcao para voltar ao topo da pagina;
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth'
                        });
    
                        setTimeout(function() {
                            window.location.reload(true);
                        }, 1000);
                    }
                }
            })
        })
    </script>
@endsection
