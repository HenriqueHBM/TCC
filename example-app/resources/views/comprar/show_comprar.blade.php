<div class="modal-header">
    <h4 class="modal-title">Confirmar Pagamento</h4>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body d-flex">
    <form action="" id="confirmarPagamentoForm" method="POST" class="w-100 d-flex">
        @csrf
        <input type="hidden" name="id_produto" id="id_produto" value={{ $produto->id_produto }}>
        <div class="m-2 w-50">
            <div>
                <h5>Info. Produto</h5>
            </div>
            <div class="border card_produto p-3">
                <div class="form-group mb-3">
                    <h4>{{ $produto->produto }} </h4>
                </div>
                <div class="form-group mb-2 card_produto format_valor ">
                    <h5>R$: {{ $produto->preco }}</h5>
                    <input type="text" hidden id="preco_produto" value="{{ $produto->preco }}">
                </div>
                <span>
                    Forma de Pagamento:
                </span>
                <div class="caixa_pagamento mt-1 card_produto">
                    <!-- Os valores desses inputs sao os id da tabela de pagamentos --> 
                    <input name="tp_pagamento" type="radio" id="val_boleto" class="mudar_input_pagamento val_desconto"
                        value="3">
                    <label for="val_boleto" class="mudar_label_pagamento">Boleto</label>

                    <input name="tp_pagamento" type="radio" id="val_pix" class="mudar_input_pagamento val_desconto"
                        checked value="1">
                    <label for="val_pix" class="mudar_label_pagamento">Pix</label>

                    <input name="tp_pagamento" type="radio" id="val_cartao" class="mudar_input_pagamento val_desconto"
                        value="2">
                    <label for="val_cartao" class="mudar_label_pagamento">Cartão</label>

                </div>
                <span>
                    <h6 class="mt-1 ms-2 text-success" id="desconto_pagamento">(10% de Desconto)</h6>
                    <input type="hidden" name="val_desconto_insere" id="val_desconto_insere" value="10">
                </span>
                <div class="form-group mt-4">
                    Quantidade Desejada
                    <input type="number" name="qtde_desejada" id="qtde_desejada" class="form-control card_produto"
                        value="1" min='1' max='{{ $produto->qtde }}'>
                        <p class=" alert error_qtde_desejada alert-danger font" role="alert" hidden></p>
                </div>
                <span>
                    <h6 class="mt-1 ms-2 text-secondary" id="qtde_estoque">(Qtde. Estoque: {{ $produto->qtde }})</h6>
                    <input type="hidden" name="qtde_estoque_insere" id="qtde_estoque_insere"
                        value="{{ $produto->qtde }})">
                </span>
                <div class="form-group mt-4 p-1">
                    <h5>Total R$: <span id="show_total"></span></h5>
                    <input type="text" hidden id="total_pagamento" name="total_pagamento">
                </div>
            </div>
        </div>
        <div class="m-2 w-50">
            <div>
                <h5>Info. Vendedor</h5>
            </div>
            <div class="border p-2 card_produto">
                <div class="d-flex">
                    <div class="d-flex mt-2">
                        <img src="{{ url('storage/img_perfils/'.$produto->usuario->foto_perfil) }}" alt="Foto Perfil"
                            class="rounded-circle d-inline border card_produto" width="85" height="85">
                    </div>
                    <div class="p-3 pt-4">
                        <b>Vendedor:</b><br>
                        {{ $produto->vendedor->nome }}
                    </div>
                </div>
                <div class="p-2 my-2">
                    <div class="mt-3 d-flex align-content-center">
                        <div class="mt-2 me-2">
                            <img src="{{ asset('icons/endereco.png') }}" alt="Endereço" width="30" height="30">
                        </div>
                        <div class="font">
                            <b>Endereço: </b><br>
                            {{ $produto->vendedor->endereco->ceps->cidade }}
                        </div>
                    </div>
                    <div class="mt-3 d-flex">
                        <div class="mt-2 me-2">
                            <img src="{{ asset('icons/calendario.png') }}" alt="Endereço" width="30" height="30">
                        </div>
                        <div class="font">
                            <b>Usuário desde: </b><br>
                            {{ data_format($produto->vendedor->created_at) }}
                        </div>
                    </div>
                    <div class="mt-3 d-flex">
                        <div class="mt-2 me-2">
                            <img src="{{ asset('icons/email.png') }}" alt="Endereço" width="30" height="30">
                        </div>
                        <div class="font">
                            <b>E-mail para contato:</b> <br>
                            {{ $produto->vendedor->email }}
                        </div>
                    </div>
                    <div class="mt-3 d-flex">
                        @if (isset($produto->vendedor->id_empresa))
                            <div class="mt-2 me-2">
                                <img src="{{ asset('icons/empresa.png') }}" alt="Endereço" width="30"
                                    height="30">
                            </div>
                            <div class="font">
                                <b>Empresa:</b><br>
                                {{ $produto->vendedor->empresa->nome }}
                            </div>
                        @else
                            <div style="height: 45px"></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal-body mx-3 justify-content-between">
    <div class="row">
        <div class="col-sm-6 ">
            <img src="{{ asset('icons/cartaos.png') }}" alt="Cartão" width="40" height="40"
                class="mx-2">
            <label for="">Segurança em Seu Pagamento</label>
        </div>
        <div class="col-sm-6">
            <img src="{{ asset('icons/escudo.png') }}" alt="Segurança" width="40" height="40"
                class="mx-2">
            <label for="">Vendedor Verificado</label>
        </div>
    </div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-warning button_comprar p-3 m-2  card_shadow" data-id="{{ $produto->id_produto }}"
        id="confirmar_compra">Confirmar</button>
</div>
