@extends('layouts.app')
@section('title', 'ForLife')
@section('content')
{{-- <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script> --}}

<x-mensagem />
    <main class="main">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        
        <div class="container bg-light card-produto rounded-2 p-3" style="width: 600px">
            <form id ="save_register" method="POST">
                @csrf
                <div class="row pt-3 text-center">
                    <h4>Cadastrar Endereço</h4>
                </div>
                <hr>

                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="cep" >CEP</label> <!-- Exemplo de como é para fazer -->
                        <input class="form-control" list="browsers" id="browser" type="text"/>
                        
                        <datalist id="browsers">
                            <option value="">Nenhum</option>
                                @foreach ($ceps->sortBy('cidade') as $cep)
                            <option value="{{ $cep->cep }}"> {{ $cep->cidade }} - {{ $cep->sigla }}</option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="col-md-6 form-group">
                        <label for="num_residencia">NÚMERO DA RESIDÊNCIA</label>
                        <input id="num_residencia" name='num_residencia' class="form-control" type="text"
                            name="num_residencia" :value="old('num_residencia')" required />
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="rua">RUA</label>
                        <input id="rua" name='rua' class="form-control" type="text" name="rua"
                            :value="old('rua')" required autofocus />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="bairro">BAIRRO</label>
                        <input id="bairro" name='rua' class="form-control" type="text" name="bairro"
                            :value="old('bairro')" required autofocus />
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="form-group">
                        <label for="complemento">COMPLEMENTO</label>
                        <textarea id="complemento" rows="1" cols="1" name='complemento' class="form-control" type="text" name="complemento" :value="old('complemento')" autofocus> </textarea>
                    </div>
                </div>
                
                <hr>
                
                <div class="row px-3 py-1 justify-content-between">
                    <a href = "{{ route('register') }}" class="btn btn-warning col-md-4"> ⏎ VOLTAR</a>
                    <button id = "register" class="btn btn-primary col-md-4 save_edit">
                        {{ __('Registrar') }}
                    </button>
                </div>
            </form>
        </div>
    </main>
<script>
        
        $(document).on("click", "#register", function() {
        var formData = new FormData($("#save_register")[0]);
        $.ajax({
            type: "POST",
            url: "cadastrar_endereco/save_register",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                // Verifica se a resposta do servidor contém um erro
                if (data.error) {
                    // Exibe uma mensagem de erro para o usuário
                    alert('Erro: ' + data.error);
                } else {
                    // Se não houver erro, exibe uma mensagem de sucesso
                    alert('Parabéns: ' + data.success);
                    
                    
                }
            },
            error: function(xhr, status, error) {
                // Caso ocorra algum erro durante a requisição AJAX
                alert("Ocorreu um erro durante a requisição: " + status + ", " + error);
                
            }
        });
        });
    
</script>
@endsection