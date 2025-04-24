<?php
session_start();

ob_start();

include_once 'conexao.php';
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
        // echo password_hash('123456', PASSWORD_DEFAULT);

        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($dados['acessar'])) {
            //var_dump($dados);

            $sql = "SELECT id, nome, usuario, senha_usuario 
                    FROM usuarios
                    WHERE usuario = :usuario;";

            $resultUsuario = $conn->prepare($sql);
            $resultUsuario->bindParam(':usuario', $dados['usuario']);
            $resultUsuario->execute();

            if (($resultUsuario) and ($resultUsuario->rowCount() != 0)) {
                $rowUsuario = $resultUsuario->fetch(PDO::FETCH_ASSOC);

                if (password_verify($dados['senha_usuario'], $rowUsuario['senha_usuario'])) {
                    $_SESSION['usuario_id'] = $rowUsuario['id'];
                    $_SESSION['nome'] = $rowUsuario['nome'];

                    header('Location: chat.php');
                } else {
                    echo "<p style='color: #f00;'>Erro: usuário ou senha inválida</p>";
                }
            } else {
                echo "<p style='color: #f00;'>Erro: usuário ou senha inválida</p>";
            }
        }
    ?>

    <form action="" method="post">
        <label for="usuario">Email: </label>
        <input type="text" name="usuario" id="usuario" placeholder="Digita o teu nome"><br>
        <label for="senha_usuario">Senha: </label>
        <input type="password" name="senha_usuario" id="senha_usuario" placeholder="Digita a tua senha">
        <br><br>

        <input type="submit" name="acessar" value="Acessar">
        <br><br>
    </form>
</body>
</html>