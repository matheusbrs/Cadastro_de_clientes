<?php
if (isset($_POST['confirmar'])) {


    include_once("conecta.php");
    $id = intval($_GET['id']);
    $slq_code = "DELETE FROM clientes WHERE id='$id'";
    $sql_query = $mysqli->query($slq_code) or die($mysqli->error);

    if ($sql_query) {
?>
        <h1>Cliente deletado com sucesso!</h1>
        <a href="lista.php"> Voltar para lista</a>
<?php
die();
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar cliente</title>
</head>

<body>
    <h1>Tem certeza que que deletar esse cliente ?</h1>
    <a href="lista.php"><button>Não</button></a>
    <form action="" method="POST">
        <input type="submit" name="confirmar" value="sim">

    </form>

</body>

</html>