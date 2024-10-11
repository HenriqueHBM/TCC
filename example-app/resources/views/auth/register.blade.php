<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}"  enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center ">
                <div>
                    <x-label for="perfil" :value="__('Foto de Perfil')" />
                    <input type="file" name="perfil" id="perfil" class="form-control p-2 ">
                </div>
                
            </div>
            <div class="row justify-content-center">

                <img id="imagePreview" src="#" alt="Pré-visualização" style="display: none; width: 100px;height:100px; margin-top: 20px; border-radius:50%;" class="p-0 bg-light border border-3 card_produto" />
            </div>
        </body>
            <div class="row mt-2">
                <!-- Name -->
                <div>
                    <x-label for="nome" :value="__('Nome')" />

                    <x-input id="nome" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus />

                </div>
            </div>
            <div class="row mt-4">
                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required />
                </div>
            </div>

            <div class="row mt-4">
                {{-- Numero de Telefone --}}
                <div class="col col-md-6">
                    <x-label for="telefone" :value="__('Telefone')" />

                    <x-input id="telefone" class="block mt-1 w-full" type="tel" name="telefone" :value="old('telefone')"
                        required
                        placeholder='(DD) 00000-0000' />
                </div>

                {{-- Data Nascimento --}}
                <div class="col col-md-6">
                    <x-label for="data_nascimento" :value="__('Data Nascimento')" />

                    <x-input id="data_nascimento" class="block mt-1 w-full" type="date" name="data_nascimento"
                        :value="old('data_nascimento')" required />
                </div>
            </div>

            <div class="row mt-4">
                {{-- CPF --}}
                <div>
                    <x-label for="cpf" :value="__('CPF')" />

                    <x-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')"
                        required />
                </div>
            </div>


            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Senha')" />

                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirmar Senha')" />

                <x-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
<script>
    document.getElementById('perfil').addEventListener('change', function(event) {
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
</script>