<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recido de Compra</title>
</head>
<style>
    table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
            margin: 5px;
        }

        thead{
            border: 4px solid;
            background-color: rgb(228,228,228);
        }
        tbody{
            border: 4px solid;
        }
        tr > td{
            padding: 10px;
            font-size: 20px;
            text-align: justify;
        }
        #hora{
            font-size: 15px;
            color:  rgb(135, 135, 135);
            padding: 10px
        }
</style>
<body>
    <table>
        <thead>
            <tr>
                <th>
                    <h2>Recido de Compra</h2>
                </th>
                <th>
                    <h2>N°: {{ $produto->codigo }}</h2>
                </th>
                <th>
                    <h2>Total R$: {{ $compra->valor_total}}</h2>
                </th>
            </tr>
        </thead>
    </table>
    <table >
        <tbody >
            <tr >
                <td colspan="2">
                    O Produto: 
                </td>
                <td >
                    {{ $produto->produto }}, <br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Val. Unitário: 
                </td>
                <td>
                    R$: {{ $produto->preco }}, <br>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Qtde.: 
                </td>
                <td>
                    {{ $compra->qtde  }},
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Forma de Pagamento:
                </td>
                <td>
                    {{ $compra->pagamento->tipo_pag }} ({{ $compra->pagamento->desconto }}%),
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Vendido por: 
                </td>
                <td >
                    {{ $produto->vendedor->nome }},
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Foi comprado na data de:
                </td>
                <td  >
                    {{ Carbon\Carbon::today()->format('d/m/Y') }},
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Pelo Comprador: 
                </td>
                <td >
                    {{ Auth::user()->nome }}
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Podendo este ser retirado no local:
                </td>
                <td >
                    Bairro: <b>{{ $produto->vendedor->endereco->bairro }}</b>, <br>
                    Rua: <b>{{ $produto->vendedor->endereco->rua }}</b>, <br>
                    N°: <b>{{ $produto->vendedor->endereco->numero_residencia }}</b>,
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    Ou podendo contatar o vendedor no telefone: 
                </td>
                <td >
                    {{ $produto->vendedor->telefone }}.
                </td>
            </tr>
            <tr>
                <td colspan="2">Descrição do Produto:</td>
                <td>{{ $produto->descricao }}</td>
            </tr>
        </tbody>
    </table>
    <span id="hora">Horario Impresso: {{ Carbon\Carbon::now()->format('H:i') }}</span>
</body>
</html>