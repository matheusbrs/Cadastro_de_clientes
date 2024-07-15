<?php
include_once('conecta.php');
$colsulta_sql = "SELECT *  FROM clientes";
$query_bd = $mysqli->query($colsulta_sql) or die($mysqli->error);
$cliente_num = $query_bd->num_rows;




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de clientes cadastrados</title>
</head>

<body>

    <h1 style="text-align: center;">Tabela de clientes</h1>

    <table border="1" style="margin:0 auto;">
        <thead>
            <th>ID</th>
            <th>NOME</th>
            <th>E-MAIL</th>
            <th>SENHA</th>
            <th>TELEFONE</th>
            <th>CPF</th>
            <th>NASCIMENTO</th>
            <th>ENDEREÇO</th>
            <th>D/H REGISTRO</th>
            <th colspan="2">AÇÕES</th>
        </thead>

        <?php
        if ($cliente_num == 0) {
        ?>

            <tr>
                <td colspan="9" style="text-align: center;">Nenhum Cliente Cadastrado</td>

            </tr>


            <?php
        } else {

            while ($cliente = $query_bd->fetch_assoc()) {

                if ($cliente['telefone']) {
                    $ddd = substr($cliente['telefone'], 0, 2);
                    $parte1 = substr($cliente['telefone'], 2, 5);
                    $parte2 = substr($cliente['telefone'], 7);

                    $telefone = "($ddd) $parte1-$parte2";
                }

                if ($cliente['cpf']) {

                    $cpf_parte1 = substr($cliente['cpf'], 0, 3);
                    $cpf_parte2 = substr($cliente['cpf'], 3, 3);
                    $cpf_parte3 = substr($cliente['cpf'], 6, 3);
                    $cpf_parte4 = substr($cliente['cpf'], 9);


                    $cpf = "$cpf_parte1.$cpf_parte2.$cpf_parte3-$cpf_parte4";
                }

                if ($cliente['nascimento']) {
                    $separa = explode('-', $cliente['nascimento']);

                    if (count($separa) == 3) {

                        $nascimento = implode('/', array_reverse($separa));
                    }
                }

                if($cliente['data']){
                    $data_parte1 = substr($cliente['data'], 8, 2);
                    $data_parte2 = substr($cliente['data'], 5, 2);
                    $data_parte3 = substr($cliente['data'], 0, 4);
                    $hora_parte4 = substr($cliente['data'], 10);

                    $data = "$data_parte1/$data_parte2/$data_parte3 $hora_parte4";
                }
            ?>


                <tr>
                    <td><?php echo $cliente['id']; ?></td>
                    <td><?php echo $cliente['nome']; ?></td>
                    <td><?php echo $cliente['email']; ?></td>
                    <td><?php echo $cliente['senha']; ?></td>
                    <td><?php echo $telefone ?></td>
                    <td><?php echo $cpf ?></td>
                    <td><?php echo $nascimento ?></td>
                    <td><?php echo $cliente['endereco']; ?></td>
                    <td><?php echo $data ?></td>
                    <td><a href="deleta.php?id=<?php echo $cliente['id']; ?>">deletar</a></td>
                    <td><a href="altera.php?id=<?php echo $cliente['id']; ?>">alterar</a></td>
                </tr> 
        <?php
            }
        }

        ?>

    </table>
</body>

</html>