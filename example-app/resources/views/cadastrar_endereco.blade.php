
@extends("layouts.app")
@section("tittle", "Cadastrar Endereço")
@section("content")


<guest-layout>
    <auth-card>
        <slot name="logo">
            <a href="/">
                <application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </slot>

        <!-- Session Status -->
        <auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <auth-validation-errors class="mb-4" :errors="$errors" />

        <form id ="save_register" method="POST">
            @csrf


            <!-- Número Residência -->
            <div class = "row">

                    <!-- Cep -->
                    

                    <div class ="col col-md-6" >
                    
                        
                        <label for="cep" :value="__('CEP')" />
                        

                        <input class="form-control" list="browsers" id="browser">
                        <datalist id="browsers">
                            <option value="">Nenhum</option>
                            @foreach($ceps->sortBy('cidade') as $cep) 
                                <option value="{{$cep->cep}}" > {{$cep->cidade}} - {{$cep->sigla}}</option>
                            @endforeach
                        </datalist>
                        
                    
                    </div>    
                    
                    
                <div class ="col col-md-6" >
                    
                    <label for="num_residencia" :value="__('NÚMERO DE RESIDÊNCIA')" />

                    <input id="num_residencia" name='num_residencia' class="block mt-1 w-full" type="text" name="num_residencia" :value="old('num_residencia')" required  />
                </div>
            </div>
            
                    
            <!-- Rua -->
            <div class = "mt-4">
                <label for="rua" :value="__('RUA')" />

                <input id="rua" name='rua' class="block mt-1 w-full" type="text" name="rua" :value="old('rua')" required autofocus />
            </div>

            <!-- Bairro -->
            <div class = "mt-4">
                <label for="bairro" :value="__('BAIRRO')" />

                <input id="bairro" name='rua' class="block mt-1 w-full" type="text" name="bairro" :value="old('bairro')" required autofocus />
            </div>
        
            <!-- Complemento -->
            <div class = "mt-4">
                <label for="complemento" :value="__('COMPLEMENTO')" />

                <input id="complemento" name='rua' class="block mt-1 w-full" type="text" name="complemento" :value="old('complemento')" autofocus />
            </div>
            
            <div class = "row mt-4 justify-content-center">
                <div class = "text-center">
                    <button id = "register" type = "button" class = "btn bg-success text-white">REGISTRAR</button>
                </div>
            </div>  
            
        </form>
    </auth-card>
</guest-layout>
<script>
    $(document).on("click", "#register", function(){
        var formData = new FormData($("#save_register")[0]);
        $.ajax({
            type: "POST", 
            url: "cadastrar_endereco/save_register",
            data: formData,
            cache:false,
            contentType:false,
            processData:false,
            success:function(data){
                if(data.error){
                    setTimeout(() => {
                        alert('Vish');
                    }, 2000);
                }else{
                    alert('Parabens');
                }
            }
        })
    }) 

</script>
@endsection