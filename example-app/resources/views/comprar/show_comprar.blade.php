<div class="modal-header">
    <h4 class="modal-title">Confirmar Pagamento</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<style>
    .caixa_pagamento {
        position: relative;
        border-radius: 50px;
        overflow: hidden;

        height: 30px;
        width: 100%;

        display: flex;
        flex-direction: row-reverse;

        >* {
            flex: 0 0 33.33%;
        }

        &:after {
            content: "";

            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;

            border: 1px solid #007ECC;
            border-radius: 50px;
            pointer-events: none;
        }
    }

    .mudar_input_pagamento {
        display: none;

        &:checked+.mudar_label_pagamento {
            background-color: #007ECC;
            color: #FFFFFF;
        }

    }

    .mudar_label_pagamento {
        display: flex;
        align-items: center;
        justify-content: space-around;

        position: relative;
        cursor: pointer;
        transition: all 0.2s ease-out;
        color: #003f66;

        &:hover {
            color: #007ECC;
        }
    }
</style>
<div class="modal-body d-flex">
    <div class="m-2 w-50">
        <div>
            <h5>Info. Produto</h5>
        </div>
        <div class="border p-2 card_produto p-3">
            <div class="form-group mb-3">
                <h4>{{ $produto->produto }} R$: {{ $produto->preco }}</h4>
            </div>
            <span class="mt-5">
                Forma de Pagamento
            </span>
            <div class="caixa_pagamento mt-1 card_produto">
                <input name="tp_pagamento" type="radio" id="coloration-high" class="mudar_input_pagamento">
                <label for="coloration-high" class="mudar_label_pagamento">Boleto</label>

                <input name="tp_pagamento" type="radio" id="coloration-low" class="mudar_input_pagamento" checked>
                <label for="coloration-low" class="mudar_label_pagamento">Pix</label>

                <input name="tp_pagamento" type="radio" id="coloration-medium" class="mudar_input_pagamento">
                <label for="coloration-medium" class="mudar_label_pagamento">Cartão</label>
            </div>
            <span>
                <h6 class="mt-1 ms-2 text-success">(4% de Desconto)</h6>
            </span>
            <div class="form-group mt-4">
                Quantidade Desejada
                <input type="number" name="" id="" class="form-control card_produto">
            </div>
            <div class="form-group mt-4">
                Total:  
            </div>
        </div>
    </div>
    <div class="m-2 w-50">
        <div>
            <h5>Info. Vendedor</h5>
        </div>
        <div class="border p-2 card_produto">Esse cara sou eu</div>
    </div>
</div>
<div class="modal-body mx-3 justify-content-between">
    <div class="row">
        <div class="col-sm-6 ">
            <img src="{{ asset('icons/cartaos.png') }}" alt="Cartão" width="40" height="40" class="mx-2">
            <label for="">Segurança em Seu Pagamento</label>
        </div>
        <div class="col-sm-6">
            <img src="{{ asset('icons/escudo.png') }}" alt="Segurança" width="40" height="40" class="mx-2">
            <label for="">Vendedor Verificado</label>
        </div>
    </div>
</div>
<div class="modal-footer justify-content-between">
    {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> --}}
    <button type="button" class="btn button_comprar p-3 m-2  card_shadow">Confirmar</button>
</div>
