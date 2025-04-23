<?php
    session_start();

    ob_start();
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebSockets</title>
</head>
<body>
    <h2>Chat</h2>

    <p>Bem-vindo/a: <span id="nome-usuario"><?= $_SESSION['usuario'] ?></span></p>

    <label for="mensagem">Nova mensagem:</label>
    <input type="text" name="mensagem" id="mensagem" placeholder="Escreve uma mensagem">
    <br><br>

    <input type="button" value="Enviar" onclick="enviar()">
    <br><br>

    <span id="mensagem-chat"></span>

    <script>
        const menssagemChat = window.document.getElementById('mensagem-chat')

        const ws = new WebSocket('ws://localhost:8080')

        ws.onopen = (e) => {
            console.log('Conectado!')
        }

        ws.onmessage = (mensagemRecebida) => {
            let resultado = JSON.parse(mensagemRecebida.data)

            menssagemChat.insertAdjacentHTML('beforeend', `${resultado.mensagem} <br>`)
        }

        const enviar = () => {
            let mensagem = window.document.getElementById('mensagem')

            let nomeUsuario = window.document.getElementById('nome-usuario').textContent

            let dados = {
                mensagem: `${nomeUsuario}: ${mensagem.value}`
            }

            ws.send(JSON.stringify(dados))

            menssagemChat.insertAdjacentHTML('beforeend', `${nomeUsuario}: ${mensagem.value} <br>`)

            mensagem.value = ''
        }
    </script>
</body>
</html>