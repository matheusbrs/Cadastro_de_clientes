<?php

$hostname = "localhost";
$usuario ="root";
$senha = "";
$bd = "cadastro de clientes";

$mysqli = new mysqli($hostname, $usuario, $senha, $bd);
if($mysqli -> connect_error){
    echo'banco de dados não conectado';
}

function formata_telefone($telefone){
    if (!empty($telefone)) {
        $ddd = substr($telefone, 0, 2);
        $parte1 = substr($telefone, 2, 5);
        $parte2 = substr($telefone, 7);

       return  "($ddd) $parte1-$parte2";
    }
}

function formatar_data($nascimento){
    
    if (!empty($nascimento)) {
        $separa = explode('-', $nascimento);

        if (count($separa) == 3) {

            return  implode('/', array_reverse($separa));
        }
    }

}
?>