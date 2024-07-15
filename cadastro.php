<?php
// Função para limpar texto, removendo todos os caracteres que não são números
function limpar_texto($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}

// Verifica se o formulário foi enviado (verificando se há dados no $_POST)
if (count($_POST) > 0) {
    // Inclui o arquivo de conexão com o banco de dados
    include_once("conecta.php");

    // Inicializa a variável $error com valor 0
    $error = 0;

    // Obtém os dados enviados pelo formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $endereco = $_POST['endereco'];
    $cpf = $_POST['cpf'];
    $nascimento = $_POST['nascimento'];

    // Verifica se o campo nome está vazio
    if (empty($nome)) {
        $error = 'Favor digite seu nome';
    }
    // Verifica se o campo email está vazio
    if (empty($email)) {
        $error = 'Favor digite seu E-mail';
    }

    // Verifica se o campo telefone está vazio
    if (empty($telefone)) {
        $error = 'Favor digite seu número de telefone';
    } else {
        // Se o telefone não estiver vazio, limpa e verifica o formato
        if (!empty($telefone)) {
            $telefone = limpar_texto($telefone);
            if (strlen($telefone) != 11) {
                $error = 'Telefone deve conter o seguinte formato (61) 98888-8888';
            }
        }
    }

    // Verifica se o campo senha está vazio
    if (empty($senha)) {
        $error = 'Favor crie uma senha';
    } else {
        // Verifica se a senha tem pelo menos 8 caracteres
        if (strlen($senha) < 8) {
            $error = 'Sua senha deve conter no mínimo 8 caracteres';
        }
    }

    // Verifica se o campo endereço está vazio
    if (empty($endereco)) {
        $error = 'Favor digite seu endereço';
    }

    // Verifica se o campo CPF está vazio
    if (empty($cpf)) {
        $error = 'Favor digite seu CPF';
    } else {
        // Se o CPF não estiver vazio, limpa e verifica o formato
        $cpf = limpar_texto($cpf);

        if (strlen($cpf) != 11) {
            $error = 'CPF deve conter 11 caracteres';
        }
    }

    // Verifica se o campo nascimento está vazio
    if (empty($nascimento)) {
        $error = 'Favor digite sua data de nascimento';
    } else {
        // Se a data de nascimento não estiver vazia, verifica e converte o formato
        if (!empty($nascimento)) {
            $divide_caracteristicas = explode('/', $nascimento);

            if (count($divide_caracteristicas) == 3) {
                $nascimento = implode('-', array_reverse($divide_caracteristicas));
            } else {
                $error = 'Campo nascimento deve seguir no seguinte formato Dia/Mês/Ano';
            }
        }
    }

    // Se houve algum erro, exibe a mensagem de erro
    if ($error) {
    } else {


        // Se não houve erro, insere os dados no banco de dados
        $sql_code = "INSERT INTO clientes (nome, email, telefone, senha, endereco, cpf, nascimento)
VALUES ('$nome', '$email', '$telefone', '$senha', '$endereco', '$cpf', '$nascimento')";

        // Executa a consulta e verifica se deu certo
        $deu_certo = ($mysqli->query($sql_code) or die($mysqli->error));

        // Se a inserção foi bem-sucedida, exibe uma mensagem de sucesso
        if ($deu_certo) {
            echo "Usuário cadastrado com sucesso";
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="cadastro1.css">
</head>

<body>
    <form class="form_cadastro" action="" method="POST">
        <h1>Cadastro</h1>

        <h4 class="h2_error">
            <?php
            if (isset($error)) {
                echo $error;
  } else
            ?>
        </h4>
        <h3 style="color:green;  text-align: center;">
        <?php
           {
                echo "Usuario cadastrao com sucesso!";
            }
        ?>
        </h3>
        <div class="ctr1">
            <div>
                <input type="text" name="nome" placeholder="Nome" value="<?php if (isset($_POST['nome'])) {
                                                                                echo "$nome";
                                                                            } ?>">
                <input type="email" name="email" placeholder="E-mail" value="<?php if (isset($_POST['email'])) {
                                                                                    echo "$email";
                                                                                } ?>">
            </div>
            <div class="">
                <input type="text" name="telefone" placeholder="telefone" value="<?php if (isset($_POST['telefone'])) {
                                                                                        echo "$telefone";
                                                                                    } ?>">
                <input type="password" name="senha" placeholder="Senha" value="<?php if (isset($_POST['senha'])) {
                                                                                    echo "$senha";
                                                                                } ?>">
            </div>
            <div class="">
                <input type="text" name="endereco" placeholder="Endereço" value="<?php if (isset($_POST['endereco'])) {
                                                                                        echo "$endereco";
                                                                                    } ?>">
                <input type="text" name="cpf" placeholder="cpf" value="<?php if (isset($_POST['cpf'])) {
                                                                            echo "$cpf";
                                                                        } ?>">
            </div>
            <div>
                <input class="inp_nascimento" name="nascimento" type="text" placeholder="Nascimento" value="<?php if (isset($_POST['nascimento'])) {
                                                                                                                echo "$nascimento";
                                                                                                            } ?>">
            </div>

            <input class="bnt_cadastro" type="submit" value="cadastrar">
            <a href="lista.php">Acessar Lista de Clientes </a>
        </div>





    </form>
</body>

</html>