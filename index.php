<?php
    session_start();

    ob_start();
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In WebSockets</title>
</head>
<body>
    <h1>Acessar o Chat</h1>

    <?php
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($dados['acessar'])) {
            //var_dump($dados);

            $_SESSION['usuario'] = $dados['usuario'];

            header('Location: chat.php');
        }
    ?>

    <form action="" method="post">
        <label for="nome">Nome: </label>
        <input type="text" name="usuario" id="usuario" placeholder="Digita o teu nome">
        <br><br>

        <input type="submit" name="acessar" value="Acessar">
        <br><br>
    </form>
</body>
</html>