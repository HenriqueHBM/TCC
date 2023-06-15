<?php

function BRValue($valor){
    $valor = number_format($valor,'0',',','.');
    return $valor;
}

?>