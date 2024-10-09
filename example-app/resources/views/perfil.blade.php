@extends('layouts.app')
@section('title', 'Perfil')
@section('content')
    <div class="text-center align-content-center w-100 text-white card_produto" hidden id="mensg_sucesso"
        style="height:60px; background-color:rgb(0, 186, 71)">
        <h3>Perfil Atualizado Com Sucesso</h3>
    </div>
    <main class="main">
        <div class="container bg-light card-produto rounded-2 p-2" style="width: 600px">
            <form action="" method="POST" id="editForm">
                @csrf
                <div class="row pt-3 text-center">
                    <h4>Perfil</h4>
                </div>
                <hr>
                <div class="p-3">
                    <div class="row justify-content-center">
                        <div>
                            <label for="perfil_add" class="form-label font">Foto de Perfil</label>
                            <input type="file" name="foto_perfil" id="perfil_add" class="form-control p-2 ">
                        </div>

                    </div>
                    <div class="row justify-content-center">
                        <img id="imagePreview" src="{{ url('storage/img_perfils/' . Auth::user()->foto_perfil) }}"
                            alt="Pré-visualização" style=" width: 100px;height:100px; margin-top: 20px; border-radius:50%;"
                            class="p-0 bg-light border border-3 card_produto" />
                    </div>
                    <div class="row justify-content-center">
                        <img id="imagePreview" src="#" alt="Pré-visualização"
                            style="display: none; width: 100px;height:100px; margin-top: 20px; border-radius:50%;"
                            class="p-0 bg-light border border-3 card_produto" />
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 form-group">
                            <label for="nome_add" class="form-label font">Nome</label>
                            <input type="text" id="nome_add" name="nome" class="form-control" value="{{ Auth::user()->nome }}">
                            <p class="alert error_nome alert-danger" role="alert" hidden></p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 form-group">
                            <label for="email_add" class="form-label font">Email</label>
                            <input type="text" id="email_add" name="email" class="form-control" value="{{ Auth::user()->email }}">
                            <p class="alert error_email alert-danger" role="alert" hidden></p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label for="telefone_add" class="form-label font">Telefone</label>
                            <input type="text" id="telefone_add" name="telefone" class="form-control" value="{{ Auth::user()->telefone }}" placeholder='(DD) 00000-0000'>
                            <p class="alert error_telefone alert-danger" role="alert" hidden></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="dt_nascimento_add" class="form-label font">Data Nascimento</label>
                            <input type="date" id="dt_nascimento_add" name="dt_nascimento" class="form-control" value="{{ Auth::user()->data_nascimento }}">
                            <p class="alert error_dt_nascimento alert-danger" role="alert" hidden></p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 form-group">
                            <label for="cpf_add" class="form-label font">CPF</label>
                            <input type="text" id="cpf_add" name="cpf" class="form-control" value="{{ Auth::user()->cpf }}">
                            <p class="alert error_cpf alert-danger" role="alert" hidden></p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 form-group">
                            <label for="senha" class="form-label">Senha para confirmar alteração</label>
                            <input type="password" name="senha" id="senha" class="form-control">
                            <p class="alert error_senha alert-danger" role="alert" hidden></p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label for="nova_senha_add" class="form-label font">Nova Senha(Opcional)</label>
                            <input type="password" id="nova_senha_add" name="nova_senha" class="form-control">
                            <p class="alert error_nova_senha_add alert-danger" role="alert" hidden></p>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="nova_senha_confirmation" class="form-label font">Confirmar Nova Senha</label>
                            <input type="password" id="nova_senha_confirmation" name="nova_senha_confirmation" class="form-control">
                            <p class="alert error_nova_senha_confirmation alert-danger" role="alert" hidden></p>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row px-3 py-1 justify-content-between">
                    <a href="/home" class="btn btn-warning col-md-4">Voltar</a>
                    <button class="btn btn-primary col-md-4 save_perfil" id="save_perfil">Salvar Alteração</button>
                </div>
            </form>
        </div>
    </main>
    <script>
        document.getElementById('perfil_add').addEventListener('change', function(event) {
            console.log(event.target.files[0]);
            
            
            var file = event.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = document.getElementById('imagePreview');
                    img.src = e.target.result;
                    img.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });

        $(document).on('click', '.save_perfil', function(e) {
            var formData = new FormData($('#editForm')[0]);
            e.preventDefault();
            $.ajax({
                type: 'post',
                url: 'perfil/save_perfil',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.error) {
                        setTimeout(function() {
                            //$('#Modal').modal('show'); //caso erro, puxar a tela 
                            $.each(data.error, function(index, element) {
                                $('.error_' + index).prop('hidden', false);
                                $('.error_' + index).text(element);
                            });
                        }, 100);
                    } else if(data === 'Senha Invalida'){
                        setTimeout(function() {
                            $('.error_senha').prop('hidden', false);
                            $('.error_senha').text(data);
                        },100);
                    }
                    else {
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
        });
    </script>
@endsection
