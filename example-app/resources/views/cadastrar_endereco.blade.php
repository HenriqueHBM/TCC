<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form id ="save_register" method="POST">
            @csrf
            <!-- Número Residência -->
            <div class = "row ">
                <!-- Cep -->
                <div class ="col col-md-6 mt-2">
                    <x-label for="cep" :value="__('CEP')" />
                    <input class="form-control" list="browsers" id="browser">
                    <datalist id="browsers form-control-md">
                        <option value="">Nenhum</option>
                        @foreach ($ceps->sortBy('cidade') as $cep)
                            <option value="{{ $cep->cep }}"> {{ $cep->cidade }} - {{ $cep->sigla }}</option>
                        @endforeach
                    </datalist>
                </div>
                <div class ="col col-md-6">
                    <x-label for="num_residencia" :value="__('NÚMERO DE RESIDÊNCIA')" />

                    <x-input id="num_residencia" name='num_residencia' class="block mt-1 w-full" type="text"
                        name="num_residencia" :value="old('num_residencia')" required />
                </div>
            </div>

            <!-- Rua -->
            <div class = "mt-4">
                <x-label for="rua" :value="__('RUA')" />

                <x-input id="rua" name='rua' class="block mt-1 w-full" type="text" name="rua"
                    :value="old('rua')" required autofocus />
            </div>

            <!-- Bairro -->
            <div class = "mt-4">
                <x-label for="bairro" :value="__('BAIRRO')" />

                <x-input id="bairro" name='rua' class="block mt-1 w-full" type="text" name="bairro"
                    :value="old('bairro')" required autofocus />
            </div>

            <!-- Complemento -->
            <div class = "mt-4">
                <x-label for="complemento" :value="__('COMPLEMENTO')" />

                <x-input id="complemento" name='rua' class="block mt-1 w-full" type="text" name="complemento"
                    :value="old('complemento')" autofocus />
            </div>

            <div class = "row mt-4 justify-content-center">
                <div class = "text-center">
                    <button id = "register" type = "button" class = "btn bg-success text-white">REGISTRAR</button>
                </div>
            </div>

        </form>
    </x-auth-card>
</x-guest-layout>
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
                if (data.error) {
                    setTimeout(() => {
                        alert('Vish');
                    }, 2000);
                } else {
                    alert('Parabens');
                }
            }
        })
    })
</script>
